@extends('template')


@section('title')
    PrintKala
@stop


@section('content')


<div class="row">

    <ul id="filters" class="list-inline button-group">
        <li class="is-checked"><button data-filter="*">همه موارد</button></li>
        @foreach($cats as $cat)
            <li><button type="button" data-filter="{{ '.t'. $cat->id }}">{{ $cat->title }}</button></li>
        @endforeach
    </ul>

    <div class="isotope">
        @foreach($products as $product)
            <div class="item {{ 't'. $product->cat }} radius4 ">
                <img class="img-responsive" src="img/products/{{ $product->pic }}" alt="">
                <p>{{ $product->name }}</p>
                <span>{{ number_format($product->price) . ' ریال' }}</span>
                {!! Form::button('<i class="fa fa-shopping-basket"></i>', array('class' => 'btn btnadd btn-primary', 'data-pid' => $product->id)) !!}
                {!! Form::button('<i class="fa fa-info-circle"></i>', array('class' => 'btn btninfo btn-default')) !!}
            </div>
        @endforeach
    </div>

</div>


@stop

@section('content-js')
    <script src="{{ asset('/js/isotope.pkgd.min.js') }}"></script>

    <script type="text/javascript">

    // Isotope Script
        $(window).load(function(){
            // init Isotope
            var $container = $('.isotope').isotope({
                itemSelector: '.item',
                layoutMode: 'masonry',
            });
            // bind filter button click
            $('#filters li').on( 'click', 'button', function() {
                var filterValue = $( this ).attr('data-filter');
                $container.isotope({ filter: filterValue });
            });
            // change is-checked class on buttons
            $('.button-group li').each( function( i, buttonGroup ) {
                var $buttonGroup = $( buttonGroup );
                $buttonGroup.on( 'click','button', function() {
                    $('#filters li').removeClass('is-checked');
                    $(this).parent('li').addClass('is-checked');
                });
            });
        });

        
        $(document).ready(function(){

        // Ajax Setup
            $.ajaxSetup({
                type: 'POST',
                headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
            }); 

            
        // Add To Basket
            $('body').on('click', '.btnadd', function(event) {
                event.preventDefault();

                $('.btnadd').prop('disabled', true);

                $.ajax({
                    url: 'addbasket',
                    data: { 'pid' : $(this).data("pid") },
                })
                .done(function(data) {
                    $('.btnadd').prop('disabled', false);
                })
                .fail(function(data) {
                    console.log(data.responseText);
                })
                .always(function() {
                    // console.log(data.result);
                });
            });


        // Remove From Basket
            $('.btnrem').on('click', function(event) {
                event.preventDefault();
                $.ajax({
                    url: 'rembasket',
                    data: { 'pid' : $(this).data("pid") },
                })
                .done(function(data) {
                    $('#d-'+data.delid).fadeOut('slow');
                })
                .fail(function(data) {
                    console.log(data.responseText);
                })
                .always(function() {
                    // console.log(data.result);
                });
            }); 
        });

    </script>


@stop