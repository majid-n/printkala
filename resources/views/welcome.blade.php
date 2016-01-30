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
                <div class="myspinner">
                    <img src="{{ asset('/img/loader.gif') }}" alt="">
                </div>
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

                var target    = $(event.target),
                Loader        = target.parents('.item').find('div.myspinner'),
                FadeElement   = target.parents('.item').find('.btnadd');

                FadeElement.fadeTo(400,0,function(){
                    Loader.fadeTo(400,1);     
                });

                $.ajax({
                    url: 'addbasket',
                    data: { 'pid' : $(this).data("pid") },
                })
                .done(function(data) {
                    $('.btnadd').prop('disabled', false);
                    $('.md-trigger i' ).effect( "bounce", { times: 3 }, "slow" );
                    if (data.result == "add") {
                        $('.badge').html( Number($('.badge').html()) + 1 );
                    };
                })
                .fail(function(data) {
                    console.log(data.responseText);
                })
                .always(function() {
                    // console.log(data.result);
                    Loader.fadeTo(400,0,function(){
                        FadeElement.fadeTo(400,1);
                    });
                });
            });

        });


    </script>


@stop