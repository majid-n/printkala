@extends('template')

@section('title')
{{trans('general.register')}}
@stop

@section('content')


<div class="row">
<div class="maincontainer col-md-8 col-md-offset-2 radius4">

<div class="form-top">
	<div class="form-top-left">
		<span class="glyphicon glyphicon-user ig-color"></span>	
	</div>
	<div class="form-top-right">
		<h1>{{trans('general.register')}}</h1>	
	</div>
</div>

<div class="form-bottom">
{!! Form::open(array('class' => 'form-horizontal')) !!}
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

	<div class="form-group col-md-12{!! $errors->has('mobile') ? ' has-error' : null !!}">
		{!! Form::text('mobile', null, array('class' => 'form-control','placeholder' => ' شماره همــراه ...' )) !!}
		<p class="help-block">{!! $errors->first('mobile') !!}  </p>
		<small> شماره همراه خود را برای ارسال تراکنش های مالی وارد نمایید, شماره همراه شما در سایت محفوظ می باشد . </small>
	</div>	

	<div class="form-group{!! $errors->has('password') ? ' has-error' : null !!}">
		<div class="col-md-6">
			{!! Form::password('password', array('class' => 'form-control','placeholder' => ' کلمـــه عبور ...')) !!}
			<p class="help-block">{!! $errors->first('password') !!}</p>
		</div>
		<div class="col-md-6">
			{!! Form::password('password_confirm', array('class' => 'form-control','placeholder' => ' تکرار کلمـــه عبور ...')) !!}
			<p class="help-block">{!! $errors->first('password_confirm') !!}</p>
		</div>
	</div>

	<div class="form-group col-md-12{!! $errors->has('shout') ? ' has-error' : null !!}">
		{!! Form::text('shout',null,array('class' => 'form-control' ,'placeholder' => ' فریـــاد ...')) !!}
		<p class="help-block">{!! $errors->first('shout') !!}</p>
	</div>	


	<div class="form-group col-md-12{!! $errors->has('gender') ? ' has-error' : null !!}">
		<label class="radio-inline" for="gender">
		  <input type="radio" name="gender" id="gender"/>
		  <i></i> <span>{{trans('general.men')}}</span>
		</label>	
		<label class="radio-inline" for="gender1">
		  <input type="radio" name="gender" id="gender1"/>
		  <i></i> <span>{{trans('general.women')}}</span>
		</label>	
		<p class="help-block">{!! $errors->first('gender') !!}</p>	
	</div>	

	<div class="form-group pull-left">
		{!! Form::reset(trans('general.reset'), array('class' => 'btn btn1 btn-default')) !!}
		{!! Form::submit(trans('general.register'), array('class' => 'btn btn1 btn-ig')) !!}
	</div>
{!! Form::close() !!}
</div>


</div>
</div>


@stop

@section('content-js')
<script type="text/javascript">
$('form').validate();
</script>
@stop