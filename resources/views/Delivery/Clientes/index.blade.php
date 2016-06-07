@extends('app')

@section('content')
    <div class="container">
        <h3>Clientes</h3>
        <a href="{{ route('admin.clientes.create') }}" class="btn btn-default">Novo Cliente</a>
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
            @foreach($clientes as $cliente)
                <tr>
                    <td>{{$cliente->id}}</td>
                    <td>{{$cliente->user->name}}</td>
                    <td>
                        <a href="{{route('admin.clientes.edit', ['id' => $cliente->id])}}" class="btn btn-default btn-sm">Editar</a>

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {!! $clientes->render() !!}
    </div>
@endsection