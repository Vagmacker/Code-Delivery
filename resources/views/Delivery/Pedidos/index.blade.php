@extends('app')

@section('content')
    <div class="container">
        <h3>Pedidos</h3>
        <br><br>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Total</th>
                    <th>Data</th>
                    <th>Itens</th>
                    <th>Entregador</th>
                    <th>Status</th>
                    <th>Ação</th>
                </tr>
            </thead>

            <tbody>
            @foreach($pedidos as $pedido)
                <tr>
                    <td># {{$pedido->id}}</td>
                    <td>{{$pedido->total}}</td>
                    <td>{{$pedido->created_at}}</td>
                    <td>
                        <ul>
                            @foreach($pedido->items as $item)
                                <li>{{$item->produto->nome}}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>
                        @if($pedido->entregador)
                            {{$pedido->entregador->name}}
                        @else
                            --
                        @endif
                    </td>
                    <td>
                        {{$pedido->status}}
                    </td>
                    <td>
                        <a href="{{route('admin.pedidos.edit', ['id'=>$pedido->id])}}" class="btn btn-default btn-sm">Editar</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {!! $pedidos->render() !!}
    </div>
@endsection