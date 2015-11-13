@extends('master')

@section('title')
    Played
@stop

@section('body')       
     <h1>welkom bij contest</h1>

     <span class='QandA'> De vraag van deze periode was: </span><br />
     {!! $quiz['question'] !!}?
     <br />
     <br />
     <span class='QandA'> uw antwoord hierop was:</span><br />
     {!! $quiz['given'] !!}

     <br />
     <br />
     <span class='QandA'> het correcte antwoord was:</span><br />
     {!! $quiz['right'] !!}

     <br />
     <br />
     <span class='QandA'> shifting vraag: hoeveel personen hebben dit antwoord juist?</span><br />
     uw antwoord: {!! $quiz['shifting'] !!}
@stop