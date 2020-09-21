<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>@yield('title')</title>

    <meta name="csrf-param" content="authenticity_token" />
    <meta name="csrf-token" content="EEHyVPXwmLbfzG4COdrnCNsjvgeyrComOJ3qjZDU6AqNF96osOTwqqq6gI7TPO3nMO4J+ktQpKjtV1TcWPEb3A==" />

    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
    <!--<link rel="stylesheet" media="all" href="/assets/application.self-ee9708f0963b56e3d9629ceeb999ef2525c500573ad39a5e3fbf930eceb5c7d5.css?body=1" data-turbolinks-track="reload" />-->
    <!--<link rel="stylesheet" media="all" href="/assets/select2.self-c6ac55e050e3e6db253b3e8c575de97675e07fade527056269d9fffdc88a988b.css?body=1" data-turbolinks-track="reload" />-->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <!--<script src="/assets/jquery.self-bd7ddd393353a8d2480a622e80342adf488fb6006d667e8b42e4c0073393abee.js?body=1" data-turbolinks-track="reload"></script>-->
    <!--<script src="/assets/jquery_ujs.self-784a997f6726036b1993eb2217c9cb558e1cbb801c6da88105588c56f13b466a.js?body=1" data-turbolinks-track="reload"></script>-->
    <!--<script src="/assets/turbolinks.self-569ee74eaa15c1e2019317ff770b8769b1ec033a0f572a485f64c82ddc8f989e.js?body=1" data-turbolinks-track="reload"></script>-->
    <!--<script src="/assets/action_cable.self-5454023407ffec0d29137c7110917e1e745525ae9afbc05f52104c4cd6597429.js?body=1" data-turbolinks-track="reload"></script>-->
    <!--<script src="/assets/cable.self-6e0514260c1aa76eaf252412ce74e63f68819fd19bf740595f592c5ba4c36537.js?body=1" data-turbolinks-track="reload"></script>-->
    <!--<script src="/assets/select2.self-3d0dca634dc5f4aee8c2dddef05674d9a674214500fd7e89959dc9e7251bb717.js?body=1" data-turbolinks-track="reload"></script>-->
    <!--<script src="/assets/application.self-afe802b04eaf1de2ea762489c83c08aa4c4ff3ff13c21566e43cb710683f5abc.js?body=1" data-turbolinks-track="reload"></script>-->
    <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
    <script src="{{ asset('js/app.js') }}" defer></script>
  </head>

<body>
    <div id="app">

      <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
        <div class="container">
          <a class="navbar-brand" href="{{ url('/') }}">
            {{-- config('app.name', 'machine-managements') --}}
            machine-managements
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
           
            <ul class="navbar-nav mr-auto">
            </ul>
            
            <ul class="navbar-nav ml-auto">
            
            @guest
              <li><a class="nav-link" href="{{ route('login') }}">{{ __('ログイン') }}</a></li>
            @else
              <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                  {{ Auth::user()->name }} <span class="caret"></span>
                </a>
                <div id="dropdown" class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();">
                       {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                    </form>
                  </div>
                </li>
              @endguest
            </ul>
          </div>
        </div>
      </nav>
      <main class="py-4">
          @yield('content')
      </main>
    </div>
  </body>
</html>