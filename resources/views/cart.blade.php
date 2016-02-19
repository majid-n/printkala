@if( $items->count() > 0 )
	<div class="table-responsive">
		<table class="table table-hover basketTable">
			<thead>
				<tr>
					<td class="hidden-xs">تصویر</td>
					<td>نام محصول</td>
					<td align="center">تعداد</td>
					<td class="hidden-xs" align="center">قیمت</td>
					<td align="center">حــذف</td>
				</tr>
			</thead>
			<tbody id="tablebody">
				@foreach( $items as $item )
				<tr id="{{ 'd-' . $item->id }}">
					<td class="hidden-xs" width="auto"><img src="{{ asset('img/products') . '/' . $item->pic }}" class="basketimg shadow" alt=""> </td>
					<td>{{ $item->name }}</td>
					<td align="center">{{ $item->count }}</td>
					<td class="hidden-xs" align="left" class="itemTotal">{{ number_format($item->total). ' ریال' }}</td>
					<td align="center"><i class="fa fa-trash-o btnrem" data-id="{{ $item->id }}"></i></td>
				</tr>
				@endforeach

				<tr>
					<td>جمـــع کل :</td>
					<td class="hidden-xs"></td>
					<td class="hidden-xs"></td>
					<td align="left" class="sumTd">{{ number_format($total) . ' ریال' }}</td>
					<td class="hidden-xs"></td>
				</tr>
			</tbody>
		</table>
		<hr>

		<div class="pull-right">
			{!! Form::open(array('route' => 'cart.drop')) !!}
				<button type="submit" class="btn btn-default">خالی کردن سبد <i class="fa fa-fw fa-ban"></i></button>
			{!! Form::close() !!}
		</div>
		<div class="pull-left">
			<button class="btn btn-default md-close"><i class="fa fa-fw fa-arrow-right"></i> ادامه خرید</button>
			<a href="{{ route( 'order.index' ) }}" >
				<button class="btn btn-primary" >
					ثبت درخواست <i class="fa fa-fw fa-shopping-bag"></i>
				</button>
			</a>
		</div>
		
	</div>
@else
	<div class="emptyBasket text-center"><h4><i class="fa fa-shopping-basket"></i> سبد خرید شما خالی می باشد.</h4></div>
	<div class="pull-left">
		<button class="btn btn-default md-close"><i class="fa fa-fw fa-arrow-right"></i> ادامه خرید</button>
		<a href="{{ route( 'order.index' ) }}" >
			<button class="btn btn-primary" >
				ثبت درخواست <i class="fa fa-fw fa-shopping-bag"></i>
			</button>
		</a>
	</div>
@endif

<script src="{{ asset('/js/modalEffects.js') }}"></script>
<script type="text/javascript">

	$(document).ready(function() {
		// Remove From Basket
		$('.btnrem').on('click', function(event) {
			event.preventDefault();
			id = $(this).data("id");

			$.ajax({
			   url: 'basket/'+id,
			   data: { '_method' : 'DELETE' },
			})
			.done(function(data) {
				// var total = 1;
				// subtotal = $('tr.d-'+id+' td.itemTotal').html;
				// total -= eval(subtotal);
				// $( this ).closest('.sumTd').html(total);

				// subTotal = ($this).closest('.itemTotal').html();
				console.log(data.majid);
				// sumTd = $(this).closest('.sumTd').html();
				// $( sumTd ).html( eval(sumTd) - subTotal );
			    $('#d-'+data.delid).fadeOut('slow');
			    $('nav .badge').html( Number($('.badge').html()) - 1 );
			})
			.fail(function(data) {
			   console.log(data.responseText);
			})
			.always(function(data) {
			   // console.log($(this).data("pid"));
			});
		}); 
	});

</script>