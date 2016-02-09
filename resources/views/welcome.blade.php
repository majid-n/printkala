@extends('template')


@section('title','PrintKala')
    

@section('content')

    <div class="row">

        <ul id="filters" class="list-inline button-group">
            <li><button class="transition is-checked" data-filter="*">همه موارد</button></li>
            @foreach($cats as $cat)
                <li><button class="transition" data-filter="{{ '.t'. $cat->id }}">{{ $cat->title }}</button></li>
            @endforeach
        </ul>

        <div class="isotope">
            @foreach($products as $product)
                <div class="item {{ 't'. $product->cat }} radius4">
                    <img class="img-responsive noselect" src="img/products/{{ $product->pic }}" alt="{{ $product->name }}">
                    <p>{{ $product->name }}</p>

                    <button data-pid="{{ $product->id }}" class="btn btnadd btn-primary">
                        <span>{{ number_format($product->price) . ' ریال' }}</span>
                        <i class="fa fa-fw fa-shopping-basket"></i>
                        <div class="myspinner">
                            <span class="double-bounce1"></span>
                        </div>
                    </button>

                    {!! Form::button('<i class="fa fa-info-circle"></i>', array('class' => 'btn btninfo btn-default')) !!}
                    
                </div>
            @endforeach
        </div>

    </div>

@stop

@section('js')
    <script src="{{ asset('/js/isotope.pkgd.min.js') }}"></script>

    <script type="text/javascript">

    // Isotope Script
        $(window).load(function(){
            // init Isotope
            var $container = $('.isotope').isotope({
                itemSelector: '.item',
                layoutMode: 'masonry',
            });

            // change is-checked class on buttons
            $('.button-group li button').each( function( i, buttonGroup ) {
                var $buttonGroup = $( buttonGroup );
                $buttonGroup.on( 'click', function() {
                    $('#filters li button').removeClass('is-checked');
                    $( this ).addClass('is-checked');
                    var filterValue = $( this ).attr('data-filter');
                    $container.isotope({ filter: filterValue });
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
                FadeElement   = target.parents('.item').find('.btnadd i.fa');

                FadeElement.fadeTo("fast",0,function(){
                    Loader.fadeIn();     
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
                    $('.md-trigger i' ).effect( "shake", { times: 3 }, "slow" );
                })
                .always(function(data) {
                    Loader.fadeOut("slow",function(){
                        FadeElement.fadeTo("fast", 1);
                    });
                });
            });

        });


    </script>


@stop