@extends('template')

@section('title')

@stop


@section('content')
	
	<div class="container">
		<div class="row">

		<div class="page-header">
			<span class="fa fa-square"></span>
			<h1>ایجاد نمونه کار</h1>
		</div>

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

			<div class="form-group{!! $errors->has('description') ? ' has-error' : null !!}">
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
				<div class="form-group col-md-6">
					<div class="input-group fileInput">
					    <span class="input-group-addon">
					        <i class="fa fa-picture-o"></i>
					        <input type="file" name="pic">
					    </span>
					    <input type="text" class="form-control fileInputText" placeholder="لطفا عکس را انتخاب کنید">
					</div>
					<p class="help-block">{!! $errors->first('pic') !!}</p>
				</div>
			</div>

			<div class="form-group col-md-12{!! $errors->has('active') ? ' has-error' : null !!}">
				{!! Form::label('active', 'فعال') !!}
				{!! Form::checkbox('active', 1, array('class' => 'form-control')) !!}
				<p class="help-block">{!! $errors->first('active') !!}</p>
			</div>

			<div class="col-md-12" dir="ltr">
				{!! Form::reset('جــدید', array('class' => 'btn btn-default')) !!}
				{!! Form::submit('ذخــیره', array('class' => 'btn btn-primary')) !!}
			</div>

		{!! Form::close() !!}

		</div>
	</div>

@stop


@section('js')
	<script type="text/javascript">
		$(document).ready(function() {
		    fileInput();
		});

		// File Input customization
		function fileInput() {

		    $( 'input[type="file"]' ).each( function() {

		        var $input   = $( this ),
		            $label   = $( 'input[type="text"].fileInputText' ),
		            labelVal = $label.val();

		        $input.on( 'change', function( event ) {

		            var fileName = '';

		            if( this.files && this.files.length > 1 ) 
		                fileName = ( $(this).data( 'multiple-caption' ) || '' ).replace( '{count}', this.files.length );
		            else if( event.target.value )
		                fileName = event.target.value.split( '\\' ).pop();
		            if( fileName )
		                $label.val( fileName );
		            else
		                $label.val( labelVal );
		        });

		        // Firefox bug fix
		        $input
		        .on( 'focus', function(){ $input.addClass( 'has-focus' ); })
		        .on( 'blur', function(){ $input.removeClass( 'has-focus' ); });
		    });
		}
	</script>
@stop