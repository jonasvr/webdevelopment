<!DOCTYPE html>
<html>
    <head>
        <title>contest | @yield('title')</title>
        @yield('scripts')
        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="/css/style.css">
        <link rel="stylesheet" href="/css/global.css">
        <link rel="stylesheet" href="/css/contest.css">
        <link rel="shortcut icon" type="image/x-icon" href="/img/layout/favicon.ico" />
    </head>
    <body>
       
            <header class="group">
                <div>
                    {!! HTML::link(route('home'), 'home') !!}
                </div>
                <nav>
                    <ul>

                        @if(Auth::user())
                            <li>
                                {!! HTML::link("#", Auth::user()->email) !!}
                            </li>
                            <li> 
                                {!! HTML::link(route('logout'), 'logout') !!}
                            </li>
                            @if(Auth::user()->admin==1)
                                <li>
                                    {!! HTML::link(route('participants'), 'deelnemers') !!}
                                </li>
                                <li>
                                    {!! HTML::link(route('createinquiry'), 'toevoegen') !!}
                                </li>
                            @else
                                <li>
                                    {!! HTML::link(route('play'), 'play') !!}
                                </li>
                            @endif
                        @else
                        <li>
                            {!! HTML::link(route('register'), 'registreer') !!}
                        </li>
                        <li>
                            {!! HTML::link(route('login'), 'login') !!}
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