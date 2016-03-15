@extends('template')
@section('title','داشبورد')
@section('content')

<div class="col-md-10 col-md-offset-1">
	<div class="page-header">
	    <span class="fa fa-lg fa-chevron-left"></span>
	    <h1>سفارش های جدید</h1>
	</div>

	<div class="page-content">
		<div class="table-responsive">
			<table class="table table-striped">
				<thead>
					<tr>
						<td></td>
						<td>نام کاربر</td>
						<td>آدرس</td>
						<td>جمع فاکتور</td>
						<td>زمان درخواست</td>
						<td></td>
					</tr>
				</thead>

				<tbody>
					@define $number = 1
					@foreach( $orders as $order )
						<?php $mydate = jdate()->forge($order->created_at); ?>
						<tr>
							<td>{{ $number }}</td>
							<td>{{ $order->user->first_name . ' ' . $order->user->last_name }}</td>
							<td>{{ $order->address }}</td>
							<td>{{ number_format($order->sum) . ' ریال' }}</td>
							<td>{{ $mydate->ago() }}</td>
							<td>
								<a href="{{ route('order.show', ['order' => $order->id]) }}" class="btn btn-xs btn-default"><i class="fa fa-eye"></i></a>
								<a href="" class="btn btn-xs btn-success"><i class="fa fa-check"></i></a>
								<a href="" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
							</td>
						</tr>
						@define $number = $number + 1
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>

@stop

