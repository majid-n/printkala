
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
		<tbody>
			@foreach($basket as $item)
			<tr id="{{ 'd-' . $item->product_id }}">
				<td>{{ $item->product('name') }}</td>
				<td align="center">{{ $item->count }}</td>
				<td align="left">{{ number_format(($item->product('price') * $item->count))  . ' ریال' }}</td>
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
</div>