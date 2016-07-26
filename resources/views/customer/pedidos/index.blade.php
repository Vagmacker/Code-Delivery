@extends('app')

@section('content')
    <div class="container">
        <h3>Meus Pedidos</h3>

        <a href="{{route('customer.create')}}" class="btn btn-primary">Novo pedido</a>
        <br><br>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Total</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pedidos as $pedido)
                    <tr>
                        <td>{{$pedido->id}}</td>
                        <td>{{$pedido->total}}</td>
                        <td>{{$pedido->status}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div>
            <h5>Legenda: 0 - Pendente 1 - Entregue 2 - A Caminho 3 - Cancelado</h5>
        </div>
    </div>
    {!! $pedidos->render() !!}
@endsection