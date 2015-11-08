@extends('master')

@section('title')
    register
@stop

@section('body')
    <div class="content">
       
        <h1>register</h1>
        <!-- resources/views/auth/register.blade.php -->
                    <!--<form method="POST" action="/register">-->
                {!! Form::open(array('url' => route('register'), 'method' => 'post')) !!}
                    {!! csrf_field() !!}

                    {!! Form::label('name', 'Voornaam') !!}
                    {!! Form::text('name', '') !!}</br>

                    {!! Form::label('surname', 'achternaam') !!}
                    {!! Form::text('surname', '') !!}</br>

                    {!! Form::label('street', 'straat') !!}
                    {!! Form::text('street', '') !!}</br>

                    {!! Form::label('nr', 'nummer') !!}
                    {!! Form::text('nr', '') !!}</br>

                    {!! Form::label('additive', 'toevoegsel') !!}
                    {!! Form::text('additive', '') !!}</br>

                    {!! Form::label('city', 'stad') !!}
                    {!! Form::text('city', '') !!}</br>

                    {!! Form::label('postalcode', 'postcode') !!}
                    {!! Form::text('postalcode', '') !!}</br>

                    {!! Form::label('country', 'land    ') !!}
                    {!! Form::text('country', '') !!}</br>
                    
                    {!! Form::label('login', 'login') !!}
                    {!! Form::text('login', '') !!}</br>

                    {!! Form::label('email', 'email') !!}
                    {!! Form::text('email', '') !!}</br>

                    {!! Form::label('password', 'wachtwoord') !!}
                    {!! Form::password('password', '') !!}</br>

                    {!! Form::label('password_confirmation', 'vul wachtwoord nog eens in') !!}
                    {!! Form::password('password_confirmation', '') !!}</br>

                    {!! Form::submit() !!}
                {!! Form::close() !!}
            </div>
@stop