@extends('template')

@section('title','PrintKala')

@section('css')
    <link href="{{ asset('css/slider-settings.css') }}" rel="stylesheet">
@stop
    
@section('content')

    <!-- Slider Revolution -->
    <!-- <div class="row" style="margin-top:-40px; margin-bottom:25px;">
       include('slider')
    </div> -->

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
                            <img class="img-responsive noselect transition" src="{{ asset('images/posts/'.$product->pic) }}" alt="{{ $product->name }}">
                        </div>

                        <span class="postname">{{-- str_limit($product->name, 20) --}}
                            <input type="text" size="1" class="stepper" value="1">
                            <div class="select-style">
                                <select>
                                    @foreach( $product->cat->units as $unit )
                                        <option value="{{ $product->unitsprice->where('unit_id', $unit->id)->first()->price }}">{{ $unit->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </span>

                        <div class="btninfo textshadow">
                            <i class="fa fa-info-circle"></i>
                        </div>
                        <button data-pid="{{ $product->id }}" class="btn btnadd btn-primary">
                            <span>{{ number_format($product->unitsprice->first()->price) . ' ریال' }}</span>
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
    <script src="{{ asset('js/jquery.stepper.min.js') }}"></script>
    <script type="text/javascript">

        $(window).load(function(){
            // init Isotope
            var $container = $('.isotope').isotope({
                itemSelector:   '.item',
                layoutMode:     'masonry',
                isOriginLeft:   false
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

            // Number Stepper
            $('.stepper').each(function(index, el) {
                $(el).stepper({
                    wheel_step: 1,
                    arrow_step: 1,
                    limit: [1, 99]
                });
            });

            // Selected Unit Price
            $('.select-style select').each(function(index, el) {
                $(el).change(function () {
                    var val = $(el).find('option:selected').val(),
                    price = $(el).parents('.postname').parent('.item').find('button.btnadd span');
                    $(price).text(FormatNumber(val) + ' ریال');
                });
            });
        });

    </script>


@stop