@extends('master')

@section('title')
    home
@stop

@section('body')       
     <h1>alle deelnemers</h1>

        <table>
          <tr>
            <th>ID</th>
            <th>naam</th>
            <th>straat</th>
            <th>stad</th>
            <th>land</th>
            <th>login</th>
            <th>email</th>
            <th>delete</th>
          </tr>
          @foreach ($users as $user)
          <tr>
            <td>{{ $user->id}}</td>
            <td>{{ $user->name }} {{ $user->surname }}</td>
            <td>{{ $user->street }} {{ $user->nr }} {{ $user->additive }}</td>
            <td>{{ $user->postalcode }} {{ $user->city }}</td>
            <td>{{ $user->country }}</td>
            <td>{{ $user->loginname }}</td>
            <td>{{ $user->email }}</td>
            <td><span class="delete" title="Verwijder dit maar">
              {!! HTML::linkAction('ParticipantsController@delete', '', array('id' =>$user-> id ), array('class' => 'icon fontawesome-remove')) !!}
                 </span>
            </td>
          </tr> 
          @endforeach
         

        </table>
@stop

<!-- {!! HTML::link('participants/delete', null, array('class' => 'icon fontawesome-remove'),array('id' =>$user-> id )) !!}
                -->  