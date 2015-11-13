 @extends('master')

@section('title')
    new inquiry
@stop

@section('body')
    <div class="content">
       
        <h1>new inquiry</h1>
              {!! Form::open(array('url' => route('addInquiry'), 'method' => 'post')) !!}
                    {!! csrf_field() !!}

                    {!! Form::label('inquiry', 'vraag') !!}
                    {!! Form::text('inquiry', '') !!}</br>

                    {!! Form::label('awnser', 'antwoord') !!}
                    {!! Form::text('awnser', '') !!}</br>

                    {!! Form::label('option1', 'optie 1') !!}
                    {!! Form::text('option1', '') !!}</br>

                    {!! Form::label('option2', 'optie 2') !!}
                    {!! Form::text('option2', '') !!}</br>

                    {!! Form::label('option3', 'optie 3') !!}
                    {!! Form::text('option3', '') !!}</br>
                    
                    {!! Form::label('start', 'begin datum quiz') !!}
                    {!! Form::date('start', $min=$start) !!}</br> 

                    {!! Form::label('stop', 'eind datum quiz') !!}
                    {!! Form::date('stop', $min=$stop) !!}</br>
                    

                    {!! Form::submit() !!}
                {!! Form::close() !!}
            </div>
@stop
