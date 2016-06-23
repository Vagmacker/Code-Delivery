@extends('app)

@section('content')
    <div class="container">
        <h3>Novo pedido</h3>
        @if($errors->any())
            <ul class="alert">
                @foreach($errors->all() as $error)
                    <li>
                        {{$error}}
                    </li>
                @endforeach
            </ul>
        @endif
        <div class="container">
            {!! Form::open(['class'=>'form']) !!}

              <div class="form-group">
                <label>Total: </label>
                <p id="total"></p>
                <a href="#" class="bt btn-default">Novo Item</a>
                <br>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Produto</th>
                        <th>Quantidade</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <select class="form-control" name="items[0][produto_id]">
                                    @foreach($produtos as $produto)
                                        <option value="{{$p->id}}" data-preco="{{$produto->preco}}">
                                            {{$produto->nome}} --- {{$produto->preco}}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                {!! Form::text('items[0][qtd]', 1, ['class'=>'form-control']) !!}
                            </td>
                        </tr>
                    </tbody>
                </table>
              </div>

            {!! Form::close() !!}
        </div>
    </div>
@endsection