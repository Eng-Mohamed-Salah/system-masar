<!doctype html>
<html lang="en" data-theme="lightMode">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="{{ asset($globalVariable . 'assetsManeger') }}/img/M-.png">
    <title>Masar</title>

    <!--  Bootstrap v5.1.3 -->
    <link href="{{ asset($globalVariable . 'assetsManeger') }}/css/bootstrap.min.css" rel="stylesheet">
    <!--  font Awesome -->
    <link href="{{ asset($globalVariable . 'assetsManeger') }}/fonts/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
    <!--  Style css -->
    <link href="{{ asset($globalVariable . 'assetsCustomers') }}/css/sharedClient.css" rel="stylesheet">
    @yield('style')
</head>

<body dir="rtl">
    <div id="loadingOverlay">
        <div class="loading">
            <div class="boxLogo">
                <img src="{{ asset($globalVariable . 'assetsClinet') }}/imgs/Masar-Social-media-ابيض--.png" />
            </div>
            <div>
                <div id="loop" class="center"></div>
                <span class="lineStreet"></span>
                <div id="bike-wrapper" class="center">
                    <div id="bike" class="centerBike"></div>
                </div>
            </div>
        </div>
    </div>



    <aside>
        <div class="container">
            <div class="boxheadSide">
                <div class="d-flex flex-column">
                    <!-- logo Aside -->
                    <a href="{{ route('home') }}" class='logoaside'>
                        <img src="{{ asset($globalVariable . 'assets') }}/img/Masar-Social-media-ابيض--.png" />
                        <img src="{{ asset($globalVariable . 'assets') }}/img/M-.png" class="d-none"
                            style="width: 30px;" />
                    </a>
                    <!-- user Aside -->
                    <div class="useraside">
                        <div class="boxuser">
                            @if(Auth::user()->image)
                            <img style="object-fit: cover; object-position:center;"
                                src="{{ asset($globalVariable .'images')}}/{{Auth::user()->image}}"
                                alt="{{ Auth::user()->name }} ">
                            @else
                            <img src="{{ asset($globalVariable . 'assets') }}/img/user.png" alt=""></span>
                            @endif
                        </div>
                        <h5>{{ Auth::user()->name }} </h5>
                        <a href="">{{ Auth::user()->email }} </a>
                    </div>

                    <section>
                        <span class="openSlide btnGray d-none">
                            <i class="fa-solid fa-user-gear px-3 fa-xl"></i>

                        </span>
                        <!-- Droplist-->
                        <button class="btn btnGray" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                            <i class="fa-solid fa-chevron-down  fa-2xs"></i>
                            <span>
                                Manager
                                <i class="fa-solid fa-user-gear px-3"></i>
                            </span>
                        </button>
                        <div class="collapse" id="collapseOne">
                            <div class="card card-body">
                                @can('isAdmin')
                                <a href="{{ route('show-history') }}">History</a>
                                <a href="{{ route('show-client') }}">Client</a>
                                <a href="{{ route('show-plane') }}">Plane</a>
                                <a href="{{ route('show-galary') }}">Galary</a>
                                <a href="{{ route('show-video') }}">Video</a>
                                <a href="{{ route('show-programming') }}">Programming</a>
                                <a href="{{ route('show-marketing') }}">Marketing</a>
                                @endcan

                                @if (Auth::user()->can('isDataEntry') || Auth::user()->can('isHr') )
                                <a href="{{ route('show-client') }}">Client</a>
                                <a href="{{ route('show-plane') }}">Plane</a>
                                <a href="{{ route('show-galary') }}">Galary</a>
                                <a href="{{ route('show-video') }}">Video</a>
                                <a href="{{ route('show-programming') }}">Programming</a>
                                <a href="{{ route('show-marketing') }}">Marketing</a>
                                @endif

                            </div>
                        </div>

                    </section>
                </div>
                <div class="footerSide">
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fa-solid fa-right-from-bracket px-1"></i>
                        <span>{{ __('Logout') }}</span>
                    </a>
                    <span>{{ Auth::user()->role }}</span>
                </div>

            </div>
        </div>
    </aside>

    <div dir="ltr" class="body">
        {{-- <!-- Start Navbar --> --}}
        <nav>
            <div class="d-flex">
                {{-- Button Slider --}}
                <button id="btnSlider" class="icon">
                    <i class="fa-solid fa-bars-staggered fa-lg"></i>
                </button>
                {{-- Full Screen --}}
                <button class="icon" id="fullscreenButton">
                    <img src="{{ asset($globalVariable . 'assets') }}/img/maximize.png" id="fullscreenIcon" />
                </button>
                {{-- Dark Mode --}}
                <button class="icon d-none d-lg-inline themeicons">
                    <i class="fa-solid fa-lightbulb fa-lg themeicon btnLight"></i>
                    <i class="fa-solid fa-moon fa-lg themeicon d-none"></i>
                </button>
                {{-- Button Home --}}
                <a href="{{ route('home') }}" class="icon">
                    <i class="fa-solid fa-home fa-lg"></i>
                </a>
            </div>
            {{-- <!-- user Nav --> --}}

            {{-- Start Auth  --}}
            <span class='userNav'>
                <div class="d-flex flex-column align-items-end">
                    <div class="d-flex align-items-center">
                        <i class="fa-solid fa-chevron-down fa-2xs mx-2"></i>
                        {{ Auth::user()->name }}
                    </div>
                    <div style="font-size: 14px;" class="d-block">{{ Auth::user()->jobTitle }}</div>
                </div>
                <div class="dropdownUser d-none">
                    <a href="{{ route('admin.hr.show', Auth::user()->id  ) }}">Profile </a>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
                <span class="boxuser">
                    @if(Auth::user()->image)
                    <img style="object-fit: cover; object-position:center;"
                        src="{{ asset($globalVariable .'images')}}/{{Auth::user()->image}}"
                        alt="{{ Auth::user()->name }} ">
                    @else
                    <img src="{{ asset($globalVariable . 'assets') }}/img/user.png" alt=""></span>
                @endif
            </span>
            {{-- End Auth  --}}

        </nav>
        {{-- <!-- End Navbar --> --}}

        @yield('content')

    </div>

    <script>
    window.addEventListener('load', function() {
        var loadingOverlay = document.getElementById('loadingOverlay');
        loadingOverlay.style.display = 'none';
    });
    </script>
    <!-- Jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset($globalVariable . 'assetsManeger') }}/js/jquery.slim.min.js"></script>
    <script src="{{ asset($globalVariable . 'assetsManeger') }}/js/jquery-3.5.1.min.js"></script>
    <!-- Bootstrap -->
    <script src="{{ asset($globalVariable . 'assetsManeger') }}/js/popper.js"></script>
    <script src="{{ asset($globalVariable . 'assetsManeger') }}/js/bootstrap.min.js"></script>


    <!-- Font Awesome -->
    <script src="{{ asset($globalVariable . 'assetsManeger') }}/fonts/all.min.js"></script>

    <!-- Js Index Java Script -->
    <script src="{{ asset($globalVariable . 'assetsManeger') }}/js/sharedManeger.js"></script>

    @yield('scripts')


</body>

</html>
