@extends('template')
@section('title', $product->name )
@section('content')

<div class="col-md-10 col-md-offset-1">
	<div class="page-header">
	    <span class="fa fa-lg fa-chevron-left"></span>
	    <h1>{{ $product->name }}</h1>
	</div>

	<div class="page-content">
		<div class="col-md-6">
			<div class="table-responsive">
				<table class="table table-striped">
					<tbody>
						<tr><td>نام محصول : {{ $product->name }}</td></tr>
						<tr><td>توضیحات : {{ $product->des }}</td></tr>
						<tr><td>دسته : {{ $product->cat->title }}</td></tr>
						<tr><td>واحدها : 
								@foreach($product->cat->units as $unit)
									{{ $unit->title . ' - ' }}
								@endforeach
							</td></tr>
						<tr><td>اندازه : {{ $product->size }}</td></tr>
						<tr><td>وزن : {{ $product->weight }}</td></tr>
					</tbody>
				</table>
				{!! Form::button('<i class="fa fa-plus"></i> اضافه به سبد خرید', array('class' => 'btn btn-block btn-primary')) !!}
			</div>
		</div>
		<div class="col-md-6 text-center">
			<img class="img-responsive img-thumbnail transition noselect" src="{{ asset('images/posts/'.$product->pic) }}" alt="{{ $product->name }}">
		</div>
		<div class="clearfix"></div>
	</div>
	<br>
	<div class="pull-left">
		<a href="{{ route('home') }}" class="btn btn-default">بازگشت به صفحه اصلی <i class="fa fa-fw fa-arrow-left"></i></a>
	</div>
</div>

@stop