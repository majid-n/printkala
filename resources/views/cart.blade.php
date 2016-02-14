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
				<tr id="{{ 'd-' . $item->product_id }}">
					<td class="hidden-xs" width="auto"><img src="{{ asset('img/products') . '/' . $item->pic }}" class="basketimg shadow" alt=""> </td>
					<td>{{ $item->name }}</td>
					<td align="center">{{ $item->count }}</td>
					<td class="hidden-xs" align="left" class="itemTotal">{{ number_format($item->total). ' ریال' }}</td>
					<td align="center"><i class="fa fa-trash-o btnrem" data-pid="{{ $item->product_id }}"></i></td>
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
			<button class="btn btn-یثبشعمف">خالی کردن سبد <i class="fa fa-fw fa-ban"></i></button>
		</div>

		<div class="pull-left">
			<button class="btn md-close"><i class="fa fa-fw fa-arrow-right"></i> ادامه خرید</button>
			<a class="btn btn-primary" href="{{ route( 'cart', ['user' => Sentinel::getUser()->id] ) }}" >ثبت درخواست <i class="fa fa-fw fa-shopping-bag"></i></a>
		</div>
		
	</div>
@else
	<div class="emptyBasket"><h3><i class="fa fa-shopping-basket"></i> سبد خرید شما خالی می باشد.</h3></div>
@endif

<script src="{{ asset('/js/modalEffects.js') }}"></script>
<script type="text/javascript">

	$(document).ready(function() {
		// Remove From Basket
		$('.btnrem').on('click', function(event) {
			event.preventDefault();
			pid = $(this).data("pid");
			total = $(this).parents('td.itemTotal');

			$.ajax({
			   url: 'rembasket',
			   data: { 'pid' : pid },
			})
			.done(function(data) {
			   $('#d-'+data.delid).fadeOut('slow');
			   $('.badge').html( Number($('.badge').html()) - 1 );
			})
			.fail(function(data) {
			   console.log(data);
			})
			.always(function(data) {
			   // console.log($(this).data("pid"));
			});
		}); 
	});

</script>