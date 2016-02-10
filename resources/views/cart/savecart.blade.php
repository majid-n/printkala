@extends('template')


@section('title','PrintKala')
    

@section('content')

	<div class="row">
		<div class="col-md-8">

			<div class="panel panel-default table-responsive">
				<div class="panel-heading hidden-xs text-center">سبد خرید <b>{{ $user->first_name . ' ' . $user->last_name }}</b></div>

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
			</div>

		</div>

		<div class="col-md-4">

			<div class="panel panel-default">
			  <div class="panel-heading">
			    <h3 class="panel-title">کد تخفیف</h3>
			    <span class="pull-left"><i class="fa fa-chevron-up"></i></span>
			  </div>
			  <div class="panel-body">

			    <div class="panel-body">
			    	{!! Form::open() !!} 
			    		<p>کد تخفیفی را در این قسمت وارد کنید.</p>
			    		<div class="form-group">
			    			{!! Form::text('discount', null, array('class' => 'form-control', 'style' => 'height: 40px;')) !!}
			    		</div>
			    		{!! Form::button('دریافت تخفیف', array('class' => 'btn btn-default btn-block')) !!}
			    	{!! Form::close() !!}
			    </div>

			  </div>
			</div>

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
							<td align="left"><span><font size="2">{{ $total . ' ریال' }}</font></span></td>
						</tr>

						<tr>
							<td><span>هزینه حمل</span></td>
							<td align="left"><span><font size="2">{{ '+ '. config('app.keraye') .' ریال' }}</font></span></td>
						</tr>
					</thead>
					<tfoot style="border-top:1px solid #eee;">
						<tr>
							<td><span>مجوع کل</span></td>
							<td align="left"><span><font size="5">{{ '= ' . ($total + config('app.keraye')) . ' ریال' }}</span></td>
						</tr>
					</tfoot>
				</table>

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