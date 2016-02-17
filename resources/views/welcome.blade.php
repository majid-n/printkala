@extends('template')


@section('title','PrintKala')
    

@section('content')

    <div class="row">

        <ul id="filters" class="list-inline">
            <li><button class="transition is-checked" data-filter="*">همه موارد</button></li>
            @foreach($cats as $cat)
                <li><button class="transition" data-filter="{{ '.t'. $cat->id }}">{{ $cat->title }}</button></li>
            @endforeach
        </ul>

        <div class="isotope">
            @foreach($products as $product)
                <div class="item {{ 't'. $product->cat_id }} shadow">
                    
                    <div class="postimg">
                        <img class="img-responsive noselect transition" src="img/products/{{ $product->pic }}" alt="{{ $product->name }}">
                    </div>

                    <span class="postname">{{ $product->name }}</span>

                    <div class="btninfo textshadow">
                        <i class="fa fa-info-circle"></i>
                    </div>

                    <button data-pid="{{ $product->id }}" class="btn btnadd btn-primary">
                        <span>{{ number_format($product->price) . ' ریال' }}</span>
                        <i class="fa fa-fw fa-shopping-basket"></i>
                        <div class="myspinner">
                            <span class="double-bounce1"></span>
                        </div>
                    </button>

                </div>
            @endforeach
        </div>

    </div>

@stop

@section('js')
    <script src="{{ asset('/js/isotope.pkgd.min.js') }}"></script>

    <script type="text/javascript">

        $(window).load(function(){
        // init Isotope
            var $container = $('.isotope').isotope({
                itemSelector: '.item',
                layoutMode: 'masonry',
            });

        // change is-checked class on buttons
            $('#filters li button').each( function( i, buttonGroup ) {
                var $buttonGroup = $( buttonGroup );
                $buttonGroup.on( 'click', function() {
                    $('#filters li button').removeClass('is-checked');
                    $( this ).addClass('is-checked');
                    var filterValue = $( this ).attr('data-filter');
                    $container.isotope({ filter: filterValue });
                });
            });
        });

        $(document).ready(function() {
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
                    console.log(data.responseText);
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