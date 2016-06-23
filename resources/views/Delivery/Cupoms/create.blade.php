@extends('app')

@section('content')
    <div class="container">
        <h3>Novo Cupom</h3>
        @if($errors->any())
            <ul class="alert">
                @foreach($errors->all() as $error)
                    <li>
                        {{$error}}
                    </li>
                @endforeach
            </ul>
        @endif
        {!! Form::open(['route' => 'admin.cupoms.store', 'class'=>'form']) !!}
            <div class="form-group">
                {!! Form::label('Codigo', 'Código:') !!}
                {!! Form::text('code', null, ['class' => 'form-control']) !!}
            </div>
        <div class="form-group">
            {!! Form::label('Valor', 'Valor:') !!}
            {!! Form::text('value', null, ['class' => 'form-control']) !!}
        </div>
            <div class="form-group">
                {!! Form::submit('Criar Cupom', ['class' => 'btn btn-primary']) !!}
            </div>

        {!! Form::close() !!}
    </div>
@endsection