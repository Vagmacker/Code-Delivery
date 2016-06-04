@extends('app')

@section('content')
    <div class="container">
        <h3>Produtos</h3>
        <a href="{{ route('admin.produtos.create') }}" class="btn btn-default">Novo Produto</a>
        <br><br>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nome/th>
                    <th>Produto</th>
                    <th>Ação</th>
                </tr>
            </thead>

            <tbody>
            @foreach($produtos as $produto)
                <tr>
                    <td>{{$produtos->nome}}</td>
                    <td>{{$produtos->categoria_id}}</td>
                    <td>
                        <a href="{{route('admin.produtos.edit', ['id' =>$produtos->id])}}" class="btn btn-default btn-sm">Editar</a>
                        <a href="{{route('admin.produtos.edit', ['id' =>$produtos->id])}}" class="btn btn-danger btn-sm">Remover</a>

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {!! $produtos->render() !!}
    </div>
@endsection