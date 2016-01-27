@extends('template')

@section('title')

@stop

@section('content')
	
	<div class="form-group{!! $errors->has('first_name') ? ' has-error' : null !!}">
		<div class="col-md-6">
			{!! Form::text('first_name', null, array('class' => 'form-control','placeholder' => ' نـــام ...')) !!}
			<p class="help-block">{!! $errors->first('first_name') !!}</p>
		</div>
		<div class="col-md-6">
			{!! Form::text('last_name', null, array('class' => 'form-control','placeholder' => ' نـــام خانوادگــی ...')) !!}
			<p class="help-block">{!! $errors->first('last_name') !!}</p>
		</div>
	</div>

	<div class="form-group col-md-12{!! $errors->has('email') ? ' has-error' : null !!}">
		{!! Form::email('email', null, array('class' => 'form-control','placeholder' => ' پست الکترونیک ...')) !!}
		<p class="help-block">{!! $errors->first('email') !!}</p>
		<small>پست الکترونیک معتبر وارد شود، لینک فعال سازی حساب کاربری ارسال می شود . </small>
	</div>
	
@stop