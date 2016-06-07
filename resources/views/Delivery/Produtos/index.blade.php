@extends('app')

@section('content')
    <div class="container">
        <h3>Produtos</h3>
        <a href="{{ route('admin.produtos.create') }}" class="btn btn-default">Novo Produto</a>
        <br><br>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Categoria</th>
                    <th>Preço</th>
                    <th>Ação</th>
                </tr>
            </thead>

            <tbody>
            @foreach($produtos as $produto)
                <tr>
                    <td>{{$produto->id}}</td>
                    <td>{{$produto->nome}}</td>
                    <td>{{$produto->categoria->name}}</td>
                    <td>{{$produto->preco}}</td>
                    <td>
                        <a href="{{route('admin.produtos.edit', ['id' =>$produto->id])}}" class="btn btn-default btn-sm">Editar</a>
                        <a href="{{route('admin.produtos.destroy', ['id' =>$produto->id])}}" class="btn btn-danger btn-sm">Remover</a>

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {!! $produtos->render() !!}
    </div>
@endsection