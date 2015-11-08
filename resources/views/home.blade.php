@extends('master')

@section('title')
    home
@stop

@section('body')       
     <h1>welkom bij contest</h1>
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
      </table>
@stop