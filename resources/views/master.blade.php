<!DOCTYPE html>
<html>
    <head>
        <title>contest | @yield('title')</title>
        @yield('scripts')
        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="/css/contest.css">
        <link rel="stylesheet" href="/css/style.css">
        <link rel="stylesheet" href="/css/global.css">
    </head>
    <body>
       
            <header class="group">
                <div>
                    <a href="{{ route('home') }}">
                        home
                    </a>
                </div>
                <nav>
                    <ul>

                        @if(Auth::user())
                              <li>
                                <a href="#">
                                  {{ Auth::user()->email }}
                                </a>
                             </li>
                             <li> 
                                <a href="{{ route('logout') }}">
                                    logout
                                </a>
                            </li>
                            @if(Auth::user()->admin==1)
                                <li>
                                    <a href="{{ route('participants') }}">
                                        deelnemers
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('createinquiry') }}">
                                        toevoegen
                                    </a>
                                </li>
                            @else
                                <li>
                                    <a href="{{ route('play') }}">
                                        play
                                    </a>
                                </li>
                            @endif
                        @else
                        <li>
                            <a href="{{ route('register') }}">
                            register
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('login') }}">
                            login
                            </a>
                        </li>
                        @endif
                    </ul>
                </nav>
            </header>
            <div class="container">

                <!-- errorlog -->
                @if (count($errors) > 0)
                    <div class="model error">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


        @yield('body')
        </div>
</body>