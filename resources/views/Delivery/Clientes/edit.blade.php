@extends('app')

@section('content')
    <div class="container">
        <h3>Editando Cliente</h3>
        @if($errors->any())
            <ul class="alert">
                @foreach($errors->all() as $error)
                    <li>
                        {{$error}}
                    </li>
                @endforeach
            </ul>
        @endif
        {!! Form::model($cliente, ['route' => ['admin.clientes.update', $cliente->id, 'class'=>'form']]) !!}
        <div class="form-group">
            {!! Form::label('Name', 'Nome:') !!}
            {!! Form::text('user[name]', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('Email', 'Email:') !!}
            {!! Form::text('user[email]', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('telefone', 'Telefone:') !!}
            {!! Form::text('numero', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('Endereco', 'Endereco:') !!}
            {!! Form::text('endereco', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('Cidade', 'Cidade:') !!}
            {!! Form::text('cidade', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('Estado', 'Estado:') !!}
            {!! Form::text('estado', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('CEP', 'CEP:') !!}
            {!! Form::text('postcode', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}
    </div>
@endsection