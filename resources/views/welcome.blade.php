@extends('template')

@section('title','PrintKala')
    
@section('content')

    <div class="row">

        <div class="page-header">
            <span class="fa fa-lg fa-chevron-left"></span>
            <h1>اضافه کردن به سبد خرید</h1>
        </div>

        <div class="page-content">
            <div id="filters" class="btn-group" role="group" >
                <button class="btn btn-default btn-primary transition" data-filter="*">همه</button>
                @foreach($cats as $cat)
                    <button class="btn btn-default transition" data-filter="{{ '.t'. $cat->id }}">{{ $cat->title }}</button>
                @endforeach
            </div>

            <div class="isotope">
                @foreach($products as $product)
                    <div class="item {{ 't'. $product->cat_id }}">
                        
                        <div class="postimg">
                            <img class="img-responsive noselect transition" src="img/products/{{ $product->pic }}" alt="{{ $product->name }}">
                        </div>

                        <span class="postname">{{ str_limit($product->name, 20) }}</span>

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
            $('#filters button').each( function( i, buttonGroup ) {
                var $buttonGroup = $( buttonGroup );
                $buttonGroup.on( 'click', function() {
                    $('#filters button').removeClass('btn-primary');
                    $( this ).addClass('btn-primary');
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
                $('.btnadd').attr('disabled', true);

                $.ajax({
                    url: '{{ route('basket.store') }}',
                    data: { 'pid' : $(this).data("pid") },
                })
                .done(function(data) {
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
                        $('.btnadd').removeAttr('disabled');
                    });
                });
            });
        });

    </script>


@stop