@extends('app')

@section('content')
    <div class="container">
        <h3>Novo Produto</h3>
        @if($errors->any())
            <ul class="alert">
                @foreach($errors->all() as $error)
                    <li>
                        {{$error}}
                    </li>
                @endforeach
            </ul>
        @endif
        {!! Form::open(['route' => 'admin.produtos.store', 'class'=>'form']) !!}
            <div class="form-group">
                {!! Form::label('Name', 'Nome:') !!}
                {!! Form::text('nome', null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('Categoria', 'Categoria:') !!}
                {!! Form::select('categoria_id', $categorias, null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('Descricao', 'Descrição:') !!}
                {!! Form::textarea('descricao', null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('Preco', 'Valor:') !!}
                {!! Form::text('preco', null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::submit('Criar Produto', ['class' => 'btn btn-primary']) !!}
            </div>

        {!! Form::close() !!}
    </div>
@endsection