@extends('template')


@section('title','PrintKala')
    

@section('content')

	<div class="row">
		<div class="col-md-8">

			<!-- Shopping History -->
			<div class="panel panel-default table-responsive">
				<div class="panel-heading hidden-xs text-center">وضعیت سفارش ها
					<i class="fa fa-trash pull-left"></i>
				</div>
				<div class="list-group">
					@if( $user->orders->count() > 0 )
						@foreach( $user->orders as $order )
							<?php $mydate = jdate()->forge($order->created_at); ?>

							@if( $order->status === 0 )
								<a href="{{ route('order.destroy', ['order' => $order->id]) }}" class="btn btn-default btn-delOrder">
									<i class="fa fa-remove fa-fw"></i>
								</a>
								<a href="{{ route('order.show', ['order' => $order->id]) }}" style="padding-right:30px;" class="list-group-item {{ 'd-' . $order->id }}">
									در حال بررسی. تاریخ ثبت : {{ $mydate->ago() }}
									<span class="badge hidden-xs">{{ number_format($order->sum) . ' ريال' }}</span>
								</a>
							@elseif( $order->status === 1 )
								<a href="{{ route('order.show', ['order' => $order->id]) }}" class="list-group-item list-group-item-success">
									سفارش شما در تاریخ {{ $mydate->format('%d %B %Y') }}، ساعت {{ $mydate->format('time') }} ارسال شد.
									<span class="badge hidden-xs">{{ number_format($order->sum) . ' ريال' }}</span>
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
							<td>تصویر</td>
							<td>محصول</td>
							<td align="center">تعداد</td>
							<td align="center">فی</td>
							<td align="center">مجموع</td>
							<td></td>
						</tr>
					</thead>

					<tbody>
						@define $number = 1
						@foreach( $items as $item )
							<tr id="d-{{ $item->id }}">
								<td width="auto"><img src="{{ asset('images/posts/'.$item->pic) }}" class="basketimg shadow" alt="{{ $item->name }}"> </td>
								<td>{{ $item->name }}</td>
								<td align="center">{{ $item->count. ' ' .$unit->where('id', $item->unit_id)->first()->title }}</td>
								<td align="left">{{ number_format($item->price). ' ریال' }}</td>
								<td align="left" class="itemTotal">{{ number_format($item->total). ' ریال' }}</td>
								<td align="center"><i class="fa fa-trash-o btnrem" data-id="{{ $item->id }}"></i></td>
							</tr>
							@define $number = $number+1
						@endforeach
					</tbody>
				</table>
				@else
					<div class="emptyBasket"><h3><i class="fa fa-shopping-basket"></i> سبد خرید شما خالی می باشد.</h3></div>
				@endif
			</div>
			<div class="pull-right">
				<a href="{{ route('home') }}" class="btn btn-default"><i class="fa fa-fw fa-arrow-right"></i> ادامه خرید</a>
			</div>

			<div class="pull-left">
				{!! Form::open(array('route' => 'cart.drop')) !!}
					<button type="submit" class="btn btn-default"><i class="fa fa-fw fa-ban"></i> خالی کردن سبد</button>
				{!! Form::close() !!}
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
			    		<p>کد تخفیف را در این قسمت وارد کنید.</p>
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
			    	{!! Form::open( array( 'route' => 'order.store', 'id' => 'postOrderForm' ) ) !!}

					@if( $user->address1 )
	                    {!! Form::radio('address', $user->address1) !!}
	                    {{ $user->address1 }}
	                    @if($user->address2) <hr> @endif
					@endif

					@if( $user->address2 )
						{!! Form::radio('address', $user->address2) !!}
	                    {{ $user->address2 }}
					@endif

					@if( $user->address3 )
						<hr>
	                    {!! Form::radio('address', $user->address3) !!}
	                    {{ $user->address3 }}
	                @else
	                	<hr>
	                	{!! Form::button('<i class="fa fa-fw fa-plus"></i> اضافه کردن آدرس جدید', array('class' => 'btn btn-default btn-block btnaddaddress')) !!}
						<div class="input-group addaddress">
							{!! Form::text('address', null, array('class' => 'form-control', 'placeholder' => 'آدرس جدید...')) !!}
							<span class="input-group-btn">
								{!! Form::button('<i class="fa fa-plus"></i>', array('class' => 'btn btn-primary')) !!}
							</span>
						</div>
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
								<td align="left" class="totalSum">{{ number_format($total) . ' ریال' }}</td>
							</tr>

							<tr>
								<td><span>هزینه حمل</span></td>
								<td align="left">{{ '+ '. number_format(config('app.keraye')) .' ریال' }}</td>
							</tr>
						</thead>

						<tfoot>
							<tr>
								<td><span>مجوع کل</span></td>
								<td align="left" class="finalSum">{{ '= ' . number_format( ($total + config('app.keraye')) ) . ' ریال' }}</td>
							</tr>
						</tfoot>
					</table>
					
						{!! Form::submit('ثبت درخواست', array('class' => 'btn btn-primary btn-lg btn-block sabtBtn')) !!}
					{!! Form::close() !!}
				</div>
			</div>

		</div>

	</div>

@stop



@section("js")

	<script type="text/javascript">

		// Check Address First
	    $(".sabtBtn").on('click', function (e) {
	    	e.preventDefault();
	    	if ( $('.basketTable tbody tr').length > 0 ) {
		        if ( $("input[name=address]:checked").length == 0 ) {
		            alert("لطفا آدرس را انتخاب کنید!");
		        } else {
		        	$('#postOrderForm').submit();
		        }
	    	} else { alert("سبد خرید شما خالی می باشد."); }
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

		// Add Address Form
		$('.btnaddaddress').each(function(index, el) {
			$(el).on('click', function(event) {
				event.preventDefault();
				addtext = $(el).next('div.addaddress');
				addbtn = $(addtext).find('span button');
				$(el).fadeOut('fast', function() {
					$(addtext).fadeIn();
					$(addtext).find('input[type=text]').focus();
					$(addtext).focusout(function(event) {
						$(addtext).fadeOut('fast', function() {
							$(el).fadeIn();
						});
					});
				});
			});
		});

		// Remove From Basket
		$('.btnrem').on('click', function(event) {
		    event.preventDefault();
		    id = $(this).data("id");
		    $('.btnrem').attr('disabled', 'true');
 
		    $.ajax({
		       url: 'basket/'+id,
		       data: { '_method' : 'DELETE' },
		    })
		    .done(function(data) {
		     	subtotal = $('tr#d-' + id).find('td.itemTotal').html().split(" ")[0].replace(/,/g, '');
		     	total = $('.totalSum').html().split(" ")[0].replace(/,/g, '');
		     	$('.totalSum').html( FormatNumber(total - subtotal) + ' ریال' );
		     	$('.finalSum').html( ' =' + FormatNumber( (total - subtotal)+ {{ config('app.keraye') }} ) + ' ریال' );

		        $('#d-'+data.delid).fadeOut('slow');
		    })
		    .fail(function(data) {
		       console.log(data.responseText);
		    })
		    .always(function(data) {
		       $('.btnrem').removeAttr('disabled');
		    });
		}); 

		// Add Address Ajax
		$('div.addaddress span button').on('click', function(event) {
			event.preventDefault();
			address = $(this).closest('.addaddress').find('input[type=text]').val();

			$.ajax({
			    url: 'address',
			    data: { 'new' : address },
			})
			.done(function(data) {
				if ( data.aid === 3 ) {
					$('.btnaddaddress').fadeOut();
					var newaddress = '<input type="radio" class="transition" name="address" value="'+ data.result +'" /> '+ data.result;
					$('.btnaddaddress').before(newaddress);
				} else {
					var newaddress = '<input type="radio" class="transition" name="address" value="'+ data.result +'" /> '+ data.result + '<hr>';
					$('.btnaddaddress').before(newaddress);
				}
			})
			.fail(function(data) {
				console.log(data.responseText);
			})
			.always(function(data) {
				// console.log($(this).data("pid"));
			});
		});

	</script>

@stop