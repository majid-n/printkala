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

<hr>

<div class="maincontainer col-md-6 col-md-offset-3 radius4">

	<div class="page-header">
	    <span class="fa fa-lg fa-chevron-left"></span>
	    <h1>ورود به سایت</h1>
	</div>

	<div class="page-content">
		{!! Form::open(array('autocomplete' => 'off')) !!}
			<div class="form-group{{ $errors->has('email') ? ' has-error' : null }}">
				{!! Form::email('email', null, array('placeholder' => ' آدرس ایمیــل ...', 'class' => 'form-control')) !!}
				<p class="help-block">{{ $errors->first('email') }}</p>
			</div>

			<div class="form-group{{ $errors->has('password') ? ' has-error' : null }}">
				{!! Form::password('password', array('placeholder' => ' کلمـــه عبـــور ...', 'class' => 'form-control')) !!}
				<p class="help-block">{{ $errors->first('password') }}</p>
				<a role="button" href="{{ URL::to('reset') }}" class="ig-color pull-left">فراموشی کلمه عبور</a><br>
			</div>

			<div class="form-group">
				<label for="remember">
				  <input type="checkbox" id="remember"/>
				  <span>مرا به خاطر داشته باش</span>
				</label>					
			</div>
			<div class="form-group" dir="ltr">
				{!! Form::submit('ورود', array('class' => 'btn btn1 btn-primary')) !!}
				{!! Form::reset('جدید', array('class' => 'btn btn1 btn-default')) !!}
			</div>
		{!! Form::close() !!}
	</div>

</div>

@stop
