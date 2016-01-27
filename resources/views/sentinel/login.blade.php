@extends('template')

@section('title')
	ورود به سایت
@stop

@section('content')

<div class="row hidden-xs">
    <div class="col-sm-8 col-sm-offset-2 toptext text-center">
        <h2><strong>ورود</strong> به پرینت کالا</h2>
        <div class="description">
        	<p>
            	جهت استفاده از تمامی امکانات <a href="http://azmind.com"></a>, وارد شوید !
        	</p>
        </div>
    </div>
</div>

<div class="row">
<div class="maincontainer col-md-6 col-md-offset-3 radius4">

	<div class="form-top">
		<div class="form-top-left">
			<span class="glyphicon glyphicon-lock ig-color"></span>	
		</div>
		<div class="form-top-right">
			<h1>{{trans('general.login')}}</h1>	
		</div>
	</div>

	<div class="form-bottom">
		{!! Form::open(array('autocomplete' => 'off')) !!}
			<div class="form-group{{ $errors->has('email') ? ' has-error' : null }}">
				{!! Form::email('email', null, array('placeholder' => ' آدرس ایمیــل ...', 'class' => 'form-control')) !!}
				<p class="help-block">{{ $errors->first('email') }}</p>
			</div>

			<div class="form-group{{ $errors->has('password') ? ' has-error' : null }}">
				{!! Form::password('password', array('placeholder' => ' کلمـــه عبـــور ...', 'class' => 'form-control')) !!}
				<p class="help-block">{{ $errors->first('password') }}</p>
				<a role="button" href="{{ URL::to('reset') }}" class="ig-color pull-left">{{trans('general.forgetpassword')}}</a><br>
			</div>

			<div class="form-group">
				<label for="remember">
				  <input type="checkbox" id="remember"/>
				  <i></i> <span>{{trans('general.rememberme')}}</span>
				</label>					
			</div>
			<br>
			<div class="form-group pull-left">
				{!! Form::reset(trans('general.reset'), array('class' => 'btn btn1 btn-default')) !!}
				{!! Form::submit(trans('general.login'), array('class' => 'btn btn1 btn-ig')) !!}
			</div>
		{!! Form::close() !!}
	</div>

</div>
</div>

@stop
