<?php
namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;

use Illuminate\Support\Facades\Input;
use Validator;
use Sentinel;
use Activation;
use Mail;
use Request;
use Redirect;
use App\User;

class UserController extends Controller {

	public function welcome() {
		$users = User::all();
		return view()->make('welcome',compact('users','products'));
	}

	public function showLogin() {
		return view()->make('sentinel.login');
	}

	public function postLogin() {

		try	{
			$input = Input::all();

			$password = Request()->password;
			$email = Request()->email;

			$credentials = [
    			'email' => $email,
    			'password' => $password,
			];


			$rules = [
				'email' => 'required|email',
				'password' => 'required',
			];

			$validator = Validator::make($input, $rules);

			if ($validator->fails()) {
				return redirect()->back()->withInput()->withErrors($validator);
			}
			
			$remember = (bool) Input::get('remember', false);

			if (Sentinel::authenticate($credentials, $remember)) {
				return Redirect()->to('/');

				$admin = Sentinel::findRoleByName('Admins');
				$users = Sentinel::findRoleByName('Users');

				if ($user->inRole($admin)) {
				    print_r("adminnnnnn");
				} elseif ($user->inRole($users)) {
				    print_r("userrrrrrr");
				}
			}

			$errors = trans('validation.invalid_user_password');
		}

		catch (NotActivatedException $e) {
			$errors = trans('validation.account_not_active');
			// return Redirect()->to('reactivate')->with('user', $e->getUser());
		}

		catch (ThrottlingException $e) {
			$delay = $e->getDelay();
			$errors = "اکانت شما بلاک شد برای مدت {$delay} ثانیه.";
		}

		return redirect()->back()->withInput()->withErrors($errors);
	}

	public function showRegister() {
		return view()->make('sentinel.register');
	}

	public function postRegister() {
		$input = Input::all();

		$rules = [
			'first_name'	   => 'required|min:2',
			'last_name'	       => 'required|min:2',
			'email'            => 'required|email|unique:users',
			'mobile' 		   => 'required|min:11|max:11',
			'password'         => 'required',
			'password_confirm' => 'required|same:password',
			'shout' 		   => 'required|min:2|max:150',
			'gender' 		   => 'required'
		];

		$validator = Validator::make($input, $rules);

		if ($validator->fails())
		{
			return Redirect()->back()
				->withInput()
				->withErrors($validator);
		}

		if ($user = Sentinel::register($input))	{

			$usersRole = Sentinel::findRoleByName('Users');
			$usersRole->users()->attach($user);

			$activation = Activation::create($user);

			$code = $activation->code;

			$sent = Mail::send('sentinel.emails.activate', compact('user', 'code'), function($m) use ($user)
			{
				$m->to($user->email)->subject('Activate Your Account');
			});

			if ($sent === 0)
			{
				return Redirect()->to('register')
					->withErrors('Failed to send activation email.');
			}

			return Redirect()->to('login')
				->withSuccess(trans('validation.account_success'))
				->with('userId', $user->getUserId());
		}

		return Redirect::to('register')
			->withInput()
			->withErrors('Failed to register.');
	}

	public function logout() {
		Sentinel::logout();
		return Redirect::to('login');
	}

}
