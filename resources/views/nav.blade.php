<nav class="navbar navbar-fixed-top navbar-default noselect">
   <div class="container-fluid">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
         <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbarkalaz" aria-expanded="false">
            <span class="sr-only">بازکردن منو</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
         </button>
         <a class="navbar-brand" href="{{ route('home') }}">
            <div>
               <img src="{{ asset('/img/logo.png') }}" alt="" width="40">               
            </div>
         </a>

         @if( Sentinel::check() )
            <div class="nav navbar-nav navbar-left">
               
               <div class="btn btn-primary md-trigger" data-modal="cartModal">
                  <i class="fa fa-shopping-cart"></i>
                  <span class="badge noselect">{{ isset($num) ? $num : "" }}</span>
               </div>
            </div>
         @endif
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="navbarkala">
         <ul class="nav navbar-nav">
            <li class="active"><a href="{{ route('home') }}">صفحه اصلی</a></li>
         </ul>

         @if( !Sentinel::check() )
            <ul class="nav navbar-nav navbar-left">
               <li><a href="{{ route('login') }}">ورود</a></li>
               <li><a href="{{ route('register') }}">ثبت نام</a></li>
            </ul>
         @endif
      
         <ul class="nav navbar-nav navbar-right">
            @if($user = Sentinel::check())
               <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                     {{ $user->first_name . " " . $user->last_name}}
                     <span class="caret"></span>
                  </a>
                  <ul class="dropdown-menu">
                     @if(Sentinel::inRole('admins'))
                        <li><a href="{{ route('dashboard') }}">مدیریت درخواست ها</a></li>
                        <li><a href="{{ route('product.create') }}">مدیریت محصولات</a></li>
                     @endif
                     <li><a href="{{ route('order.index') }}">صفحه ثبت خرید</a></li>
                     <li role="separator" class="divider"></li>
                     <li><a href="{{ route('logout') }}">خروج</a></li>
                  </ul>
               </li>
            @endif
         </ul>
      </div><!-- /.navbar-collapse -->

   </div><!-- /.container-fluid -->
</nav>