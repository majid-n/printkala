<?php
namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Illuminate\Http\Request;
use App\Http\Requests;
use Validator;
use Sentinel;
use Activation;
use Mail;
use Redirect;
use App\User;
use App\Basket;
use DB;

class UserController extends Controller {

	# Show Login Page
	public function showLogin() {
		return view('sentinel.login');
	}

	# Authenticate User
	public function postLogin( Request $request ) {

	    try {

	        $input      = $request->all();
	        $remember   = (boolean) $request->remember;

	        $credentials = [
	            'email'     => $request->email,
	            'password'  => $request->password,
	        ];

	        $rules = [
	            'email'    => 'required|email',
	            'password' => 'required|alpha_num|min:6|max:20',
	        ];

	        $validator = Validator::make( $input, $rules );

	        if ( $validator->fails() ) {
	            return back()->withInput()
	                         ->withErrors($validator);
	        }

	        if ( $user = Sentinel::authenticate($credentials, $remember) ) {
	            if     ( Sentinel::inRole( 'admins' ) ) return redirect()->route('product');
	            elseif ( Sentinel::inRole( 'users'  ) ) return redirect()->route('home');
	        }

	        return redirect()->route('login')->withInput()->with('fail', 'آدرس ایمیل یا رمز عبور شما اشتباه است.');
	    }

	    catch (NotActivatedException $e) {
	        return redirect()->route('reactivate')->with([
	            'fail'      => 'اکانت شما فعال نمی باشد.',
	            'user'      => $e->getUser()
	        ]);
	    }

	    catch (ThrottlingException $e) {
	        return back()->with('fail', 'اکانت شما بلاک شد برای مدت '.$e->getDelay().' ثانیه.');
	    }
	}

	# Show Register Page
	public function showRegister() {
		return view()->make('sentinel.register');
	}

	# Store the New User
	public function postRegister( Request $request ) {

	    $input = $request->all();

	    $rules = [
	        'first_name'       => 'required|farsi|min:2',
	        'last_name'        => 'required|farsi|min:2',
	        'email'            => 'required|email|unique:users',
	        'password'         => 'required|alpha_num|min:6|max:20',
	        'password_confirm' => 'required|same:password',
	    ];

	    $validator = Validator::make( $input, $rules );

	    if ( $validator->fails() ) {
	        return back()->withInput()
	                     ->withErrors($validator);
	    }

	    if ( $user = Sentinel::register($input) ) {

	        # Assgin role to Registred User
	        $role = Sentinel::findRoleByName('users');
	        $role->users()->attach($user);

	        # Create Activation Code for Registered User
	        $activation = Activation::create($user);

	        Mail::send('emails.activate', ['activation' => $activation, 'user' => $user], function ($message) use ($user) {

	            $message->from(config('app.info_email'), 'کامت');
	            $message->sender(config('app.info_email'), 'کامت');
	            $message->to($user->email, $user->first_name." ".$user->last_name)->subject('کد فعال سازی');
	            $message->replyTo(config('app.security_email'), 'تیم امنیتی کامت');
	        });

	        return redirect()->route('login')->with([
	            'success'   => 'اکانت شما با موفق ساخته شد.',
	            'userid'    => $user->id
	        ]);
	    }

	    return back()->withInput()
	                 ->with('fail', 'خطا در اتصال به سرور، لطفا بعدا امتحان کنید.');
	}

	# Logout User from this device
	public function logout() {
	    Sentinel::logout();
	    return redirect()->route('home');
	}

	# Logout User from all Devices
	public function logoutEverywhere(){
	    Sentinel::logout( null, true );
	    return redirect()->route('home');
	}

	public function cart( User $user ) {
		$total = 0;
		$items = Basket::select(DB::raw('products.price,products.name,products.pic,baskets.count,baskets.product_id,baskets.count*products.price as total'))
							->join('products', 'products.id', '=', 'baskets.product_id')
							->where('baskets.user_id', '=',Sentinel::getUser()->id)
							->get();

		foreach ($items as $item) {
			$total += $item->total;
		}

		return view('cart.savecart', compact('items', 'total', 'user'));
	}

	public function cartPost() {

	}

}
