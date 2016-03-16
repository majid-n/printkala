@extends('template')

@section('title')

@stop


@section('content')
	
<div class="container">
	<div class="row">

		<div class="page-header">
			<span class="fa fa-lg fa-chevron-left"></span>
			<h1>ایجاد محصول جدید</h1>
		</div>

		<div class="page-content">
			{!! Form::open(['files' => true, 'route' => 'product.store']) !!}

				<div class="form-group">
					<div class="col-md-6 {!! $errors->has('product') ? ' has-error' : null !!}">
						{!! Form::text('product', null, array('class' => 'form-control','placeholder' => ' نـــام محصول')) !!}
						<p class="help-block">{!! $errors->first('product') !!}</p>
					</div>
					<div class="col-md-6 {!! $errors->has('category') ? ' has-error' : null !!}">
						{!! Form::select('category', $listArray,'test', array('class' => 'form-control catselect')) !!}
						<p class="help-block">{!! $errors->first('category') !!}</p>
					</div>
				</div>

				<div class="form-group col-md-12 {!! $errors->has('price') ? ' has-error' : null !!} catunits">
				</div>

				<div class="form-group col-md-12 {!! $errors->has('description') ? ' has-error' : null !!}">
					{!! Form::textarea('description', null, array('class' => 'form-control','placeholder' => ' توضیحات محصول','rows' => 4)) !!}
					<p class="help-block">{!! $errors->first('description') !!}</p>
				</div>

				<div class="form-group">
					<div class="col-md-6 {!! $errors->has('size') ? ' has-error' : null !!}">
						{!! Form::text('size', null, array('class' => 'form-control','placeholder' => ' اندازه')) !!}
						<p class="help-block">{!! $errors->first('size') !!}</p>
					</div>
					<div class="col-md-6 {!! $errors->has('weight') ? ' has-error' : null !!}">
						{!! Form::text('weight', null, array('class' => 'form-control','placeholder' => ' وزن')) !!}
						<p class="help-block">{!! $errors->first('weight') !!}</p>
					</div>
				</div>

				<div class="form-group col-md-6 {!! $errors->has('image') ? ' has-error' : null !!}">
					<div class="input-group fileInput">
					    <span class="input-group-addon">
					        <i class="fa fa-picture-o"></i>
					        <input type="file" name="image">
					    </span>
					    <input type="text" class="form-control fileInputText" placeholder="لطفا عکس را انتخاب کنید">
					</div>
					<p class="help-block">{!! $errors->first('image') !!}</p>
				</div>

				<div class="form-group {!! $errors->has('active') ? ' has-error' : null !!}">  
				  	{!! Form::label('active', 'فعال بودن محصول' ) !!}
				  	{!! Form::checkbox('active', 0 ) !!}
					<p class="help-block">{!! $errors->first('active') !!}</p>
				</div>

				<div dir="ltr">
					{!! Form::submit('ذخــیره', array('class' => 'btn btn-primary')) !!}
					{!! Form::reset('جــدید', array('class' => 'btn btn-default')) !!}
				</div>

			{!! Form::close() !!}
		</div>

		<br>

		<div class="panel panel-default table-responsive">
			<div class="panel-heading hidden-xs text-center">وضعیت سفارش ها</div>

			<table class="table table-hover basketTable">
				<tbody>
					@foreach( $products as $product )
						<?php $mydate = jdate()->forge($product->created_at); ?>
						<tr>
							<td><img src="{{ asset('images/posts/'.$product->pic) }}" class="basketimg shadow" alt="{{ $product->name }}"></td>
							<td>{{ $product->name }}</td>
							<td>{{ $product->cat->title }}</td>
							<td>{{ $product->size }}</td>
							<td>{{ $mydate->format('%d %B %Y') }}</td>
							<td>
								@if( $product->active ) <span class="label label-success">فعال</span>
								@else <span class="label label-danger">غیرفعال</span> @endif
							</td>
							<td>
								<a href="" class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></a>
								<a href="" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>

			<div class="text-center">{!! $products->render() !!}</div>
			
		</div>

	</div>
</div>

@stop


@section('js')
	<script type="text/javascript">
		$(document).ready(function() {

		    fileInput();

			// Load Units Ajax
			$('.catselect').on('change', function(event) {
			    id = $(this).find('option:selected').val();
			
			    $.ajax({
			       url: '{{ route('units.show') }}',
			       data: { catid : id },
			    })
			    .done(function(data) {
			    	$('.catunits').html(data);
			    	$('.catunits input').number(true);
			    })
			    .fail(function(data) {
			       console.log(data.responseText);
			    })
			    .always(function(data) {
			    	// ...
			    });
			}); 
		});
		
	</script>
@stop