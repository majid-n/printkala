<nav class="navbar navbar-default">
   <div class="container-fluid">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
         <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
         </button>
         <a class="navbar-brand" href="#">
         <img src="{{ asset('/img/logo.png') }}" alt="" width="30">
         </a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse">
         <ul class="nav navbar-nav">
            <li class="active"><a href="{{ route('home') }}">صفحه اصلی</a></li>
         </ul>

         @if( !Sentinel::check() )
            <ul class="nav navbar-nav navbar-left">
               <li><a href="{{ route('login') }}">ورود</a></li>
               <li><a href="{{ route('register') }}">ثبت نام</a></li>
            </ul>
         @else
            <div class="nav navbar-nav navbar-left">
               <span class="badge noselect">{{ isset($num) ? $num : 0 }}</span>
               <div class="btn btn-primary md-trigger" data-modal="cartModal">
                  <i class="fa fa-shopping-cart"></i>
               </div>
            </div>
         @endif
      
         <ul class="nav navbar-nav navbar-right">
            @if($user = Sentinel::check())
               <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                     {{ $user->first_name . " " . $user->last_name}}
                     <span class="caret"></span>
                  </a>
                  <ul class="dropdown-menu">
                     <li><a href="{{ route('product') }}">مدیریت محصولات</a></li>
                     <li><a href="#">Another action</a></li>
                     @if(Sentinel::inRole('admins'))
                        <li><a href="#">ADMIN</a></li>
                     @endif
                     <li role="separator" class="divider"></li>
                     <li><a href="{{ route('logout') }}">خروج</a></li>
                  </ul>
               </li>
            @endif
         </ul>
      </div><!-- /.navbar-collapse -->

   </div><!-- /.container-fluid -->
</nav>