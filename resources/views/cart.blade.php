
<div class="table-responsive">
	<table class="table">
		<thead>
			<tr>
				<td>نام محصول</td>
				<td align="center">تعداد</td>
				<td align="center">قیمت</td>
				<td align="left">حــذف</td>
			</tr>
		</thead>
		<tbody id="tablebody">
			@foreach($items as $item)
			<tr id="{{ 'd-' . $item->product_id }}">
				<td>{{ $item->name }}</td>
				<td align="center">{{ $item->count }}</td>
				<td align="left">{{ number_format($item->total). ' ریال' }}</td>
				<td align="center"><i class="fa fa-trash btnrem" data-pid="{{ $item->product_id }}"></i></td>
			</tr>
			@endforeach

			<tr>
				<td>جمـــع کل :</td>
				<td></td>
				<td align="left">{{ number_format($total) . ' ریال' }}</td>
				<td></td>
			</tr>
		</tbody>
	</table>
	<button class="md-close">بستن</button>
	<p hidden>{{ $count }}</p>
</div>

<script type="text/javascript">

	// Remove From Basket
	$('.btnrem').on('click', function(event) {
		event.preventDefault();

		$.ajax({
		   url: 'rembasket',
		   data: { 'pid' : $(this).data("pid") },
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

</script>