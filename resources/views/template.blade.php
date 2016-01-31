<!DOCTYPE html>
<html lang="en">

   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">

      <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
      <meta name="_token" content="{{ csrf_token() }}" />

      <title>{{ config('app.sitename') . " | " }} @yield('title')</title>
      <meta name="keywords" content="@yield('keywords')">
      <meta name="description" content="@yield('description')">
      <meta name="author" content="PrintKala">
      <meta name="copyright" content="MajiD Noorali | smart.graphist[at]gmail.com" />
      <meta property="og:title" content="@yield('title') | {{ config('app.sitename') }}"/>
      <meta property="og:image" content="@yield('image')"/>
      <meta property="og:site_name" content="{{config('app.sitename')}}"/>
      <meta property="og:description" content="@yield('facebook-description')"/>

      <!-- Bootstrap core CSS -->
      <link href="{{ asset('/css/bootstrap.css') }}" rel="stylesheet">
      <link href="{{ asset('/css/bootstrap-rtl.css') }}" rel="stylesheet">
      <link href="{{ asset('/css/font-awesome.min.css') }}" rel="stylesheet">
      <link href="{{ asset('/css/styles.css') }}" rel="stylesheet">
      <link href="{{ asset('/css/modal.css') }}" rel="stylesheet">
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
   </head>
  
   @yield('content-css')

   <body>

      @include('nav')

      <div class="container">
      
         @if ($errors->any())
            <div class="alert alert-danger alert-block">
               <button type="button" class="close" data-dismiss="alert"><i class="fa fa-minus-square"></i></button>
               <strong>{{trans('general.error')}}</strong>
               @if ($message = $errors->first(0, ':message'))
                  {{ $message }}
               @else
                  {{trans('validation.check_errors')}}
               @endif
            </div>
         @endif

         @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
               <button type="button" class="close" data-dismiss="alert"><i class="fa fa-minus-square"></i></button>
               <strong>{{trans('general.success')}}</strong> {{ $message }}
            </div>
         @endif


         @yield('content')

      <!-- Cart Modal -->
         <div class="md-modal md-effect-8" id="cartModal">
            <div class="md-content">
               <h3>سبد خرید</h3>
               <div class="cartContent">
                  <div class="customSpinner">
                     <img src="{{ asset('/img/loader.gif') }}" alt="">
                  </div>
               </div>
            </div>
         </div>

      <!-- Modal Overlay -->
         <div class="md-overlay"></div>


      </div> <!-- Container -->

      <script src="{{ asset('/js/jquery.min.js') }}"></script>
      <script src="{{ asset('/js/jquery-ui.min.js') }}"></script>
      <script src="{{ asset('/js/bootstrap.min.js') }}"></script>
      <script src="{{ asset('/js/classie.js') }}"></script>
      
      
      <script type="text/javascript">

         $(document).ready(function() {

         // Load Basket
            $('body').on('click', '.md-trigger', function(event) {
               event.preventDefault();
               $('.customSpinner').css('display', 'block');

               $.ajax({
                  url: 'loadbasket',
               })
               .done(function(data) {
                  $('.cartContent').html(data.cartdata);
                  $('.badge').html( data.count );
               })
               .fail(function(data) {
                  console.log(data.responseText);
               })
               .always(function(data) {
                  $('.customSpinner').css('display', 'none');
               });
            });

         });

      </script>

      @yield('content-js')

      <script src="{{ asset('/js/modalEffects.js') }}"></script>

   </body>
</html>
