@extends('app')

@section('content')
    <div class="container">
        <h3>Categorias</h3>
        <a href="{{ route('admin.categorias.create') }}" class="btn btn-default">Nova Categoria</a>
        <br><br>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Ação</th>
                </tr>
            </thead>

            <tbody>
            @foreach($categorias as $categoria)
                <tr>
                    <td>{{$categoria->id}}</td>
                    <td>{{$categoria->name}}</td>
                    <td>
                        <a href="{{route('admin.categorias.edit', ['id' =>$categoria->id])}}" class="btn btn-default btn-sm">Editar</a>

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {!! $categorias->render() !!}
    </div>
@endsection