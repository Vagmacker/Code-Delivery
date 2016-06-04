@extends('app')

@section('content')
    <div class="container">
        <h3>Editando Produto</h3>
        @if($errors->any())
            <ul class="alert">
                @foreach($errors->all() as $error)
                    <li>
                        {{$error}}
                    </li>
                @endforeach
            </ul>
        @endif
        {!! Form::model($produto, ['route' => ['admin.produtos.update', $produtos->id, 'class'=>'form']]) !!}
        <div class="form-group">
            {!! Form::label('Name', 'Nome:') !!}
            {!! Form::text('nome', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::submit('Salvar Produto', ['class' => 'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}
    </div>
@endsection