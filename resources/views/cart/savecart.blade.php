@extends('template')


@section('title','PrintKala')
    

@section('content')

	<div class="row">
		<div class="col-md-8">

			<!-- Shopping History -->
			<div class="panel panel-default table-responsive">
				<div class="panel-heading hidden-xs text-center">تاریخچه سفارش ها</b></div>
				<div class="list-group">
					@if( $user->orders->count() > 0 )
						@foreach( $user->orders as $order )
							@if( $order->status === 0 )
								<a href="#" class="list-group-item">در حال بررسی. تاریخ ثبت : {{ $order->created_at }}
									<span class="badge">{{ number_format($order->sum) . ' ريال' }}</span>
								</a>
							@elseif( $order->status === 1 )
								<a href="#" class="list-group-item list-group-item-success">سفارش شما در تاریخ {{ $order->updated_at }} ارسال شد.
									<span class="badge">{{ number_format($order->sum) . ' ريال' }}</span>
								</a>
							@endif
						@endforeach
					@else
						<a href="#" class="list-group-item">سفارشی موجود نمی باشد.</a>
					@endif
				</div>
			</div>

			<!-- Shopping Items Table -->
			<div class="panel panel-default table-responsive">
				@if( $items->count() > 0 )
				<table class="table table-hover basketTable">
					<thead>
						<tr>
							<td>#</td>
							<td>تصویر</td>
							<td>محصول</td>
							<td align="center">تعداد</td>
							<td align="center">فی</td>
							<td align="center">مجموع</td>
							<td align="center">حذف</td>
						</tr>
					</thead>

					<tbody>
						@define $number = 1
						@foreach( $items as $item )
							<tr>
								<td>{{ $number }}</td>
								<td width="auto"><img src="{{ asset('img/products') . '/' . $item->pic }}" class="basketimg shadow" alt="{{ $item->name }}"> </td>
								<td>{{ $item->name }}</td>
								<td align="center">{{ $item->count }}</td>
								<td align="left">{{ number_format($item->price). ' ریال' }}</td>
								<td align="left" class="itemTotal">{{ number_format($item->total). ' ریال' }}</td>
								<td align="center"><i class="fa fa-trash-o btnrem" data-pid="{{ $item->product_id }}"></i></td>
							</tr>
							@define $number = $number+1
						@endforeach
					</tbody>
				</table>
				@else
					<div class="emptyBasket"><h3><i class="fa fa-shopping-basket"></i> سبد خرید شما خالی می باشد.</h3></div>
				@endif
			</div>

		</div>

		<div class="col-md-4">

			<!-- Discount Panel -->
			<div class="panel panel-default">
				<div class="panel-heading">
			    	<h3 class="panel-title">کد تخفیف</h3>
			    	<span class="pull-left"><i class="fa fa-chevron-down"></i></span>
				</div>

			    <div class="panel-body discountBody">
			    	{!! Form::open() !!} 
			    		<p>کد تخفیفی را در این قسمت وارد کنید.</p>
			    		<div class="form-group">
			    			{!! Form::text('discount', null, array('class' => 'form-control', 'style' => 'height: 40px;')) !!}
			    		</div>
			    		{!! Form::button('دریافت تخفیف', array('class' => 'btn btn-default btn-block')) !!}
			    	{!! Form::close() !!}
			    </div>
			</div>

			<!-- Address Panel -->
			<div class="panel panel-default">
				<div class="panel-heading">
			    	<h3 class="panel-title">انتخاب آدرس</h3>
			    	<span class="pull-left"><i class="fa fa-chevron-down"></i></span>
				</div>

			    <div class="panel-body">
		    	    @if( $user->address1 != null )
		    	    	<label><input type="radio" name="address[]" /> {{ $user->address1 }}</label>
		    	    @endif
		    	    @if( $user->address2 != null )
		    	    	<label><input type="radio" name="address[]" /> {{ $user->address2 }}</label>
		    	    @endif
		    	    @if( $user->address3 != null )
		    	    	<label><input type="radio" name="address[]" /> {{ $user->address3 }}</label>
		    	    @endif
			    </div>
			</div>

			<!-- Price and Save Panel -->
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">مجموع کل پرداختی</h3>
					<span class="pull-left"><i class="fa fa-chevron-up"></i></span>
			  	</div>
				<div class="panel-body">
					<table class="table">
						<thead>
							<tr>
								<td><span>مجموع</span></td>
								<td align="left"><span><font size="2">{{ number_format($total) . ' ریال' }}</font></span></td>
							</tr>

							<tr>
								<td><span>هزینه حمل</span></td>
								<td align="left"><span><font size="2">{{ '+ '. number_format(config('app.keraye')) .' ریال' }}</font></span></td>
							</tr>
						</thead>

						<tfoot style="border-top:1px solid #eee;">
							<tr>
								<td><span>مجوع کل</span></td>
								<td align="left"><span><font size="5">{{ '= ' . number_format( ($total + config('app.keraye')) ) . ' ریال' }}</span></td>
							</tr>
						</tfoot>
					</table>
					{!! Form::open(array('route' => 'cart.post', $user->id )) !!}
						{!! Form::submit('ثبت درخواست', array('class' => 'btn btn-primary btn-block')) !!}
					{!! Form::close() !!}
				</div>
			</div>

		</div>

	</div>

@stop



@section("js")

	<script type="text/javascript">

	// Check Address First
		$(function () {
		    $("#frmpostorder").submit(function (e) {
		    	e.preventDefault();
		    	var tableSize = $('table.cartpage tbody tr').length;
		        if(tableSize == 0) {
		        	alert("سبد خرید شما خالی است !");
		        } else if (!$('input[name="address"]').is(':checked')) {
		            alert("لطفا آدرس را انتخاب کنید!");
		        }
		    });
		});

	// Panel Collapse Script
		$(document).on('click', '.panel-heading', function(e){
		    var $this = $(this);
			if(!$this.hasClass('panel-collapsed')) {
				$this.parents('.panel').find('.panel-body').slideUp();
				$this.addClass('panel-collapsed');
				$this.find('i').removeClass('fa-chevron-up').addClass('fa-chevron-down');
			} else {
				$this.parents('.panel').find('.panel-body').slideDown();
				$this.removeClass('panel-collapsed');
				$this.find('i').removeClass('fa-chevron-down').addClass('fa-chevron-up');
			}
		})

	</script>

@stop