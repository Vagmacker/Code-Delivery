@extends('app')

@section('content')
    <div class="container">
        <h3>Pedidos</h3>
        <br><br>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Ação</th>
                </tr>
            </thead>

            <tbody>
            @foreach($pedidos as $pedido)
                <tr>
                    <td>{{$pedido->id}}</td>
                    <td>
                        <a href="#" class="btn btn-default btn-sm">Editar</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {!! $pedido->render() !!}
    </div>
@endsection