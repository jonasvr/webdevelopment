@extends('master')

@section('title')
    home
@stop

@section('body')       
    <h1>Welkom bij de Doctor Contest </h1>

    Welkom bij de Doctor Who wedstrijd.<br \>
    Elke periode komt er een vraag online,<br \> Doctor Who gerelateerd natuurlijk.<br \>
    <br \>
    Wat moet je doen om te winnen? <br \>
    Beantwoord de vraag correct (pas op je hebt maar 1 kans),<br \>
    vul de shiftingsvraag in (de 3 personen die het dichtsbij zijn winnen),
    <br \>en win!
    <br \>
    <br \>
    <br \>
    


    @if(Auth::user())
    {!! HTML::link(route('play'), 'play',array('class' => 'btn'), true) !!}
        
      @else
      nog niet geregistreerd?
      <br \>
      <br \>
      {!! HTML::link(route('register'), 'registreer',array('class' => 'btn'), true) !!}
         </a>        
     @endif
    
     @if($winners!=false)
      <h3>vorige winnaars</h3>
        <table>
          <tr>
            <th> vraag </th>
            <th> antwoord </th>
            <th> winnaars </th>
          </tr>
           @foreach($winners as $person)
               <tr>
                <td> {{ $person->question }} </td>
                <td> {{ $person->awnser }} </td>
                <td> {{ $person->surname }} {{ $person->name }} </td>
              </tr>
            @endforeach
        @endif
      </table>
@stop