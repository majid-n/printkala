@extends('template')

@section('title')

@stop


@section('css')
	<link href="{{ asset('css/file-input.css') }}" rel="stylesheet">

	<!-- remove if modernizer included -->
	<script>(function(e,t,n){var r=e.querySelectorAll("html")[0];r.className=r.className.replace(/(^|\s)no-js(\s|$)/,"$1js$2")})(document,window,0);</script>
@stop


@section('content')
	
<div class="container">
	<div class="row">

	{!! Form::open() !!}

		<div class="form-group{!! $errors->has('product') ? ' has-error' : null !!}">
			<div class="col-md-6">
				{!! Form::text('product', null, array('class' => 'form-control','placeholder' => ' نـــام محصول ...')) !!}
				<p class="help-block">{!! $errors->first('product') !!}</p>
			</div>
			<div class="col-md-6">
				{!! Form::select('category', $listArray,'test', array('class' => 'form-control')) !!}
				<p class="help-block">{!! $errors->first('category') !!}</p>
			</div>
		</div>

		<div class="form-group col-md-12{!! $errors->has('description') ? ' has-error' : null !!}">
			{!! Form::textarea('description', null, array('class' => 'form-control','placeholder' => ' توضیحات محصول ...','rows' => 4)) !!}
			<p class="help-block">{!! $errors->first('description') !!}</p>
		</div>

		<div class="form-group{!! $errors->has('size') ? ' has-error' : null !!}">
			<div class="col-md-6">
				{!! Form::text('size', null, array('class' => 'form-control','placeholder' => ' اندازه ...')) !!}
				<p class="help-block">{!! $errors->first('size') !!}</p>
			</div>
			<div class="col-md-6">
				{!! Form::text('weight', null, array('class' => 'form-control','placeholder' => ' وزن ...')) !!}
				<p class="help-block">{!! $errors->first('weight') !!}</p>
			</div>
		</div>

		<div class="form-group{!! $errors->has('price') ? ' has-error' : null !!}">
			<div class="col-md-6">
				{!! Form::text('price', null, array('class' => 'form-control','placeholder' => ' قیمت ...')) !!}
				<p class="help-block">{!! $errors->first('price') !!}</p>
			</div>
			<div class="col-md-6">
				<input type="file" name="pic" id="pic" class="inputfile inputfile-6"/>
				<label for="pic" class="form-control"><span></span> <strong><i class="fa fa-2x fa-picture-o"></i></strong></label>
				<p class="help-block">{!! $errors->first('pic') !!}</p>
			</div>
		</div>

		<div class="form-group col-md-12{!! $errors->has('active') ? ' has-error' : null !!}">
			{!! Form::label('active', 'فعال') !!}
			{!! Form::checkbox('active', 1, array('class' => 'form-control')) !!}
			<p class="help-block">{!! $errors->first('active') !!}</p>
		</div>

		<div class="pull-left">
			{!! Form::reset('جــدید', array('class' => 'btn btn-default')) !!}
			{!! Form::submit('ذخــیره', array('class' => 'btn btn-primary')) !!}
		</div>

	{!! Form::close() !!}

	</div>
</div>

@stop


@section('js')
	<script src="{{ asset('js/file-input.js') }}"></script>
@stop