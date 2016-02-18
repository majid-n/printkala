@extends('template')

@section('title','تاریخچه خرید ها')
    


@section('content')
	
	<!-- History -->
	<?php $mydate = jdate()->forge($order->updated_at); ?>

	@if( $order->status === 0 )
		<div class="alert alert-warning" role="alert">
			<b>وضعیت</b> : در حال بررسی - ( <i class="fa fa-clock-o"></i> تاریخ ثبت : {{ $mydate->ago() }}) - ( <i class="fa fa-cart-plus"></i> جمع فاکتور : {{ number_format($order->sum) }} ریال )
		</div>
	@elseif( $order->status === 1 )
		<div class="alert alert-success" role="alert">
			<b>وضعیت</b> : تحویل داده شد ( <i class="fa fa-clock-o"></i> تاریخ : {{ $mydate->format('%d %B %Y') }}، ساعت : {{ $mydate->format('time') }} ) - ( <i class="fa fa-cart-plus"></i> جمع فاکتور : {{ number_format($order->sum) }} ریال )
		</div>
	@endif


	<hr>

	<!-- History Items Table -->
	<div class="panel panel-default table-responsive">
		<table class="table table-hover basketTable">
			<thead>
				<tr>
					<td></td>
					<td>تصویر</td>
					<td>محصول</td>
					<td align="center">تعداد</td>
					<td align="center">فی</td>
					<td align="center">مجموع</td>
				</tr>
			</thead>

			<tbody>
				@define $number = 1
				@foreach( $baskets as $basket )
					@foreach( $basket->products as $product )
						<tr id="d-{{ $product->id }}">
							<td>{{ $number }}</td>
							<td width="auto"><img src="{{ asset('img/products') . '/' . $product->pic }}" class="basketimg shadow" alt="{{ $product->name }}"> </td>
							<td>{{ $product->name }}</td>
							<td align="center">{{ $basket->count }}</td>
							<td align="left">{{ number_format($product->price). ' ریال' }}</td>
							<td align="left" class="itemTotal">{{ number_format($basket->count * $product->price). ' ریال' }}</td>
						</tr>
					@endforeach
					@define $number = $number + 1
				@endforeach
			</tbody>
		</table>
	</div>

@stop



@section("js")

@stop