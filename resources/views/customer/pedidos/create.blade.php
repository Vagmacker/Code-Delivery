@extends('app')

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
            {!! Form::open(['route'=>'customer.store', 'class'=>'form']) !!}

              <div class="form-group">
                <label>Total: </label>
                <p id="total"></p>
                <a href="#" id="btnNewItem" class="btn btn-default">Novo Item</a>
                <br>
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
                                        <option value="{{$produto->id}}" data-price="{{$produto->preco}}">
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
            <div class="form-group">
                {!! Form::submit('Criar Pedido', ['class' => 'btn btn-primary']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('post-script')
    <script>
        $(document).ready(function(){
            $('#btnNewItem').click(function(){
                var row = $("table tbody > tr:last"),
                        newRow = row.clone(),
                        length = $('table tbody tr').length;
                newRow.find('td').each(function() {
                   var td = $(this),
                           input = td.find('input, select'),
                           name = input.attr('name');

                    input.attr('name', name.replace((length - 1) + "", length + ""));
                });

                newRow.find('input').val(1);
                newRow.insertAfter(row);
                calculaTotal();
            });
        });

        $(document.body).on('click', 'select', function() {
           calculaTotal();
        });

        $(document.body).on('blur', 'input', function() {
           calculaTotal();
        });

        function calculaTotal() {
            var total = 0,
                    trLen = $('table tbody tr').length,
                    tr = null, preco, qtd;
            for(var i = 0; i < trLen; i++) {
                tr = $('table tbody tr').eq(i);
                preco = tr.find(':selected').data('price');
                qtd = tr.find('input').val();
                total += preco * qtd;
            }

            $('#total').html(total);
        }

    </script>
@endsection