@extends('master')

@section('title')
    quiz
@stop

@section('body')       
     <h1>welkom bij contest</h1>

        {!! Form::open(array('url' => route('awnser'), 'method' => 'post')) !!}
        {!! csrf_field() !!}

        	{!! Form::label('awnser', $quiz['question']) !!}<br />

        @foreach($quiz['awnsers'] as $option)
        	{!! Form::radio('awnser', $option) !!}
        	{!! $option !!} <br />
        @endforeach

        	<br />{!! Form::label('shifting', 'Shiftingsvraag: Hoeveel deelnemers hebben deze vraag juist?') !!}<br />
            {!! Form::text('shifting', '') !!}</br>

       		{!! Form::hidden('userId', Auth::user()->id) !!}
       		{!! Form::hidden('qId', $quiz['qId']) !!}

       		{!! Form::submit() !!}
       	{!! Form::close() !!}
       
        
@stop