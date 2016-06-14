@extends('app')

@section('content')
    <div class="container">
        <h2>Pedido # {{$pedidos->id}} - R$ {{$pedidos->total}}</h2>
        <h3>Cliente: {{$pedidos->cliente->user->name}}</h3>
        <h4>Data: {{$pedidos->created_at}}</h4>

        <p>
            <b>Entregar em: </b><br>
            {{$pedidos->cliente->endereco}} - {{$pedidos->cliente->cidade}} - {{$pedidos->cliente->estado}}
        </p>
        <br>

        {!! Form::model($pedidos, ['route'=>['admin.pedidos.update', $pedidos->id]]) !!}

        <div class="form-group">
            {!! Form::label('Status', 'Status:') !!}
            {!! Form::select('status', $status, null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('Entregador', 'Entragador:') !!}
            {!! Form::select('entregador_id', $entregador, $pedidos, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}
    </div>
@endsection