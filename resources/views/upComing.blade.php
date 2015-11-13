@extends('master')

@section('title')
    opkomende vragen
@stop

@section('body')       
     <h1>opkomende wedstrijden</h1>
     
        <table>
          <tr>
            <th> vraag </th>
            <th> antwoord </th>
            <th colspan="3"> opties </th>
          </tr>
           @foreach($inquiries as $inquiry)

               <tr>
                <td> {{ $inquiry->question  }}</td>
                <td> {{ $inquiry->awnser  }}</td>
                <td> {{ $inquiry->option1  }}</td>
                <td> {{ $inquiry->option2  }}</td>
                <td> {{ $inquiry->option3  }}</td>
              </tr>
            @endforeach
       
@stop