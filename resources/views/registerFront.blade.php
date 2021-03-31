<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link
      href="https://fonts.googleapis.com/css?family=Roboto:400,400i,700&display=swap"
      rel="stylesheet"
    />
    <link type="text/css" rel="stylesheet" href="/util/datepicker/tail.datetime-default-blue.css" />
    <!-- <link href="{{asset('/jquery.datepick.css')}}" rel="stylesheet"> -->
    <script type="text/javascript" src="/util/datepicker/tail.datetime.js"></script>

    <link rel="stylesheet" href="/style.css" />
    <style>
      .redcolor {
        color: #fd397a !important;
      }
    </style>
    <title>MEDAYS</title>
  </head>
  <body>
    <header class="header">
      <nav class="navbar">
        <!-- <input type="checkbox" class="navbar__checkbox" id="navbar-toggle" /> -->
        <div class="navbar__logo-burger_container">
          <!-- <label for="navbar-toggle" class="navbar__burger">
            <span class="navbar__span"> </span>
          </label> -->
          <a href="/">
            <svg class="navbar__logo">
                <image xlink:href="/img/logo-medays-{{$lang}}.svg"></image>
            </svg>
          </a>
        </div>
        <div class="navbar__shadow"></div>
        <!-- <ul class="navbar__menu">
          <li class="navbar__item navbar__item--active">
            <a href="#">STANDARD</a>
          </li>
          <li class="navbar__separator"></li>
          <li class="navbar__item"><a href="#">PRESSE</a></li>
          <li class="navbar__separator"></li>
          <li class="navbar__item"><a href="#">Premium</a></li>
          <li class="navbar__separator"></li>
          <li class="navbar__item"><a href="#">Speaker</a></li>
        </ul> -->

        <h1 class="header__title">
          {{__('front.'.$lang.'.title')}}
        </h1>
        <ul class="navbar__lang">
          <li class="navbar__item {{('fr' == $lang) ? 'redcolor' : ''}}">
            @if(!empty($participant))
              <a href="/changelang/fr/{{$participant->id}}">FR</a>
            @else
              @if(!empty(app('request')->input('type')))
                <a href="fr?type={{app('request')->input('type')}}">FR</a>
              @else
                <a href="fr">FR</a>
              @endif
            @endif
          </li>
          <li class="navbar__separator"></li>
          <li class="navbar__item {{('en' == $lang) ? 'redcolor' : ''}}">
            @if(!empty($participant))
              <a href="/changelang/en/{{$participant->id}}">EN</a>
            @else
              @if(!empty(app('request')->input('type')))
                <a href="en?type={{app('request')->input('type')}}">EN</a>
              @else
                <a href="en">EN</a>
              @endif
            @endif
          </li>
        </ul>
      </nav>
    </header>
    <div class="content__container">
      <section class="content__standard">
        @yield('content')
      </section>
    </div>
    <footer class="footer">
      <div class="footer__container">
        <div class="footer__conds-rights">
          <a class="footer__conditions">
            {{__('front.'.$lang.'.conditionfooter')}}
          </a>
          <a class="footer__rights">
            - - {{__('front.'.$lang.'.footerrights')}}
          </a>
        </div>
        <a href="#" class="footer__link-logo">
          <svg class="footer__logo"  id="Calque_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
              viewBox="0 0 111.1 73.2" style="enable-background:new 0 0 111.1 73.2;" xml:space="preserve">
           
              <rect x="8.4" y="44.5" class="st0" width="0.9" height="8.5"/>
           
           <g>
             <path class="st0" d="M11,46.7h0.8v1.1c0.3-0.4,0.7-0.8,1.1-1c0.4-0.2,0.8-0.3,1.3-0.3c0.5,0,0.9,0.1,1.3,0.4c0.4,0.2,0.6,0.6,0.8,1
               c0.2,0.4,0.3,1,0.3,1.9V53h-0.8v-3c0-0.7,0-1.2-0.1-1.5c-0.1-0.4-0.3-0.7-0.5-0.9c-0.3-0.2-0.6-0.3-1-0.3c-0.5,0-0.9,0.2-1.3,0.5
               c-0.4,0.3-0.6,0.7-0.8,1.2c-0.1,0.3-0.1,0.9-0.1,1.7V53H11V46.7z"/>
             <path class="st0" d="M21.5,47.4L21,48c-0.4-0.4-0.9-0.6-1.3-0.6c-0.3,0-0.5,0.1-0.7,0.3c-0.2,0.2-0.3,0.4-0.3,0.6
               c0,0.2,0.1,0.4,0.2,0.6c0.2,0.2,0.5,0.4,1,0.7c0.6,0.3,1,0.6,1.2,0.9c0.2,0.3,0.3,0.6,0.3,1c0,0.5-0.2,1-0.5,1.3
               c-0.4,0.4-0.8,0.5-1.4,0.5c-0.4,0-0.7-0.1-1-0.2c-0.3-0.2-0.6-0.4-0.8-0.7l0.5-0.6c0.4,0.5,0.9,0.7,1.3,0.7c0.3,0,0.6-0.1,0.8-0.3
               c0.2-0.2,0.3-0.5,0.3-0.7c0-0.2-0.1-0.4-0.2-0.6c-0.2-0.2-0.5-0.4-1-0.7c-0.6-0.3-1-0.6-1.2-0.9c-0.2-0.3-0.3-0.6-0.3-1
               c0-0.5,0.2-0.9,0.5-1.2c0.3-0.3,0.7-0.5,1.2-0.5C20.3,46.6,20.9,46.8,21.5,47.4"/>
           </g>
           <polygon class="st0" points="23.6,44.4 24.4,44.4 24.4,46.7 25.7,46.7 25.7,47.4 24.4,47.4 24.4,53 23.6,53 23.6,47.4 22.5,47.4 
             22.5,46.7 23.6,46.7 "/>
           <g>
             <path class="st0" d="M26.8,46.7h0.8V53h-0.8V46.7z M27.2,44.1c0.2,0,0.3,0.1,0.5,0.2c0.1,0.1,0.2,0.3,0.2,0.5
               c0,0.2-0.1,0.3-0.2,0.5c-0.1,0.1-0.3,0.2-0.5,0.2c-0.2,0-0.3-0.1-0.5-0.2c-0.1-0.1-0.2-0.3-0.2-0.5c0-0.2,0.1-0.3,0.2-0.5
               C26.9,44.2,27,44.1,27.2,44.1"/>
           </g>
           <polygon class="st0" points="30,44.4 30.8,44.4 30.8,46.7 32.1,46.7 32.1,47.4 30.8,47.4 30.8,53 30,53 30,47.4 28.9,47.4 
             28.9,46.7 30,46.7 "/>
           <g>
             <path class="st0" d="M33.2,46.7h0.8v2.9c0,0.7,0,1.2,0.1,1.5c0.1,0.4,0.3,0.7,0.7,0.9c0.3,0.2,0.7,0.3,1.2,0.3
               c0.5,0,0.8-0.1,1.2-0.3c0.3-0.2,0.5-0.5,0.7-0.9c0.1-0.2,0.1-0.8,0.1-1.5v-2.9h0.8v3.1c0,0.9-0.1,1.5-0.3,2c-0.2,0.4-0.5,0.8-0.9,1
               c-0.4,0.2-0.9,0.4-1.5,0.4c-0.6,0-1.1-0.1-1.5-0.4c-0.4-0.2-0.7-0.6-0.9-1c-0.2-0.4-0.3-1.1-0.3-2V46.7z"/>
           </g>
           <polygon class="st0" points="41.3,44.4 42.1,44.4 42.1,46.7 43.4,46.7 43.4,47.4 42.1,47.4 42.1,53 41.3,53 41.3,47.4 40.2,47.4 
             40.2,46.7 41.3,46.7 "/>
           <path class="st0" d="M28,3.7c0,0,6.9,0.6,10.3,3.4C41.7,10,55.1,22.3,60,27.7c4.9,5.4,16.6,15.7,26,16.6c6.9,0,8.9-3.1,8.9-3.1
             s-4.6,2.3-10.3,0c-5.7-2.3-17.4-16.6-28-24.6C47.3,9.6,39,3.3,31.3,3.3C30.2,3.3,29.1,3.4,28,3.7"/>
           <path class="st0" d="M0,4c15.7-6.9,27.1,8.9,52,31.7c24.8,22.9,38.3,18,47.1,12.6c-2,1.1-8,2.3-13.4,2.3c-16-0.9-43.7-36-59.7-46
             C20.4,1.1,15.6,0,11.7,0C4.3,0,0,4,0,4"/>
           <path class="st0" d="M2.3,11.2c9.1-2.3,11.1,2,14.6,4.9c30,34.8,42.3,35.4,54.3,36.3C48,45.4,30.6,21.4,20.9,12.9
             c-3.7-3.3-7.3-4.3-10.4-4.3C5.6,8.6,2.3,11.2,2.3,11.2"/>
           <path class="st0" d="M67.2,19.8l2.4,1.6c3.8-2.1,8.1-3.3,12.7-3.3c14.5,0,26.3,11.8,26.3,26.3c0,14.5-11.8,26.3-26.3,26.3
             c-4.2,0-8.2-1-11.7-2.7h-5c4.7,3.3,10.5,5.3,16.7,5.3c15.9,0,28.9-12.9,28.9-28.9S98.2,15.5,82.3,15.5
             C76.7,15.5,71.6,17.1,67.2,19.8"/>
           <path class="st0" d="M14.2,57L12,61.6h4.3L14.2,57z M14.4,54.4L20.2,67h-1.3l-2-4.1h-5.5l-2,4.1H8.1l6-12.6H14.4z"/>
           <polygon class="st0" points="21.6,67 23.4,54.4 23.6,54.4 28.7,64.7 33.8,54.4 34,54.4 35.8,67 34.6,67 33.3,58 28.9,67 28.6,67 
             24.1,57.9 22.8,67 "/>
           <path class="st0" d="M43.3,57l-2.2,4.6h4.3L43.3,57z M43.4,54.4L49.3,67h-1.4l-2-4.1h-5.5l-2,4.1h-1.4l6-12.6H43.4z"/>
           <g>
             <path class="st0" d="M52.4,65.8h1.5c1.7,0,2.9-0.1,3.6-0.3c0.9-0.3,1.7-0.9,2.2-1.7c0.5-0.8,0.8-1.8,0.8-2.9c0-1.2-0.3-2.3-0.9-3.1
               c-0.6-0.9-1.4-1.5-2.5-1.8c-0.8-0.2-2.1-0.4-3.9-0.4h-0.9V65.8z M51.2,67V54.4h2.6c1.9,0,3.2,0.2,4.1,0.5c1.2,0.4,2.2,1.2,2.9,2.2
               c0.7,1.1,1,2.3,1,3.8c0,1.3-0.3,2.4-0.8,3.3c-0.5,1-1.3,1.7-2.1,2.1C58,66.7,56.8,67,55.2,67H51.2z"/>
           </g>
           <polygon class="st0" points="64.3,54.4 71.5,54.4 71.5,55.6 65.5,55.6 65.5,59.6 71.4,59.6 71.4,60.8 65.5,60.8 65.5,65.7 
             71.4,65.7 71.4,67 64.3,67 "/>
           <g>
             <path class="st0" d="M73.7,54.4H75V62c0,0.9,0,1.5,0,1.7c0.1,0.5,0.2,0.9,0.4,1.2c0.2,0.3,0.6,0.6,1.1,0.8c0.5,0.2,0.9,0.3,1.4,0.3
               c0.4,0,0.8-0.1,1.2-0.3c0.4-0.2,0.7-0.4,1-0.7c0.3-0.3,0.4-0.7,0.6-1.1c0.1-0.3,0.1-1,0.1-2v-7.6H82V62c0,1.1-0.1,2-0.3,2.7
               c-0.2,0.7-0.7,1.3-1.3,1.8c-0.7,0.5-1.5,0.8-2.4,0.8c-1,0-1.9-0.2-2.6-0.7c-0.7-0.5-1.2-1.1-1.5-1.9c-0.2-0.5-0.2-1.4-0.2-2.7V54.4
               z"/>
             <path class="st0" d="M83.8,64.6l1.1-0.6c0.8,1.4,1.6,2.1,2.6,2.1c0.4,0,0.8-0.1,1.2-0.3c0.4-0.2,0.7-0.5,0.8-0.8
               c0.2-0.3,0.3-0.7,0.3-1.1c0-0.4-0.1-0.8-0.4-1.2c-0.4-0.6-1.1-1.2-2.2-2c-1.1-0.8-1.7-1.4-2-1.7c-0.4-0.6-0.7-1.2-0.7-1.9
               c0-0.5,0.1-1,0.4-1.5c0.3-0.4,0.6-0.8,1.1-1.1c0.5-0.3,1-0.4,1.6-0.4c0.6,0,1.1,0.1,1.7,0.4c0.5,0.3,1.1,0.8,1.6,1.6l-1,0.8
               c-0.5-0.6-0.9-1-1.2-1.2c-0.3-0.2-0.7-0.3-1.1-0.3c-0.5,0-0.9,0.2-1.2,0.5c-0.3,0.3-0.5,0.7-0.5,1.1c0,0.3,0.1,0.5,0.2,0.8
               c0.1,0.3,0.3,0.5,0.6,0.8c0.2,0.2,0.7,0.6,1.6,1.3c1.1,0.8,1.8,1.5,2.2,2.1c0.4,0.6,0.6,1.3,0.6,1.9c0,0.9-0.3,1.7-1,2.4
               c-0.7,0.7-1.5,1-2.5,1c-0.8,0-1.5-0.2-2.1-0.6C84.9,66.2,84.4,65.6,83.8,64.6"/>
           </g>
           </svg>
           
        </a>
      </div>
    </footer>
    <script src="{{ asset('assets/vendors/general/jquery/dist/jquery.js') }}" type="text/javascript"></script>
    <script type="text/javascript" src="{{ asset('jquery.inputmask.js')}}" charset="utf-8"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
    <script src="/util/inputmask/inputmask.js"></script> 
    <!------------- MyJS --------------> 
    <script src="/js/inputmask.js"></script> 
    <!-- <script src="/js/file-input.js"></script>  -->
    <script src="/js/datepicker.js"></script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-148735081-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'UA-148735081-1');
    </script>
    @yield('scripts')

    <script>
        var form = document.querySelector('form');
        if (form) {
            form.addEventListener('submit', function () {
                this.querySelector('input[type="submit"]')
                    .setAttribute('disabled', 'disabled');
            }, false);
        }
    </script>

    <!-- <script>
      console.log("test");
      var foopicker = new FooPicker({
        id: "birthdate",
        dateFormat: "MM/dd/yyyy"
      });
    </script> -->
  </body>
</html>
