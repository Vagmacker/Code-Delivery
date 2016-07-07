<?php

Route::get('/home', function (){
   return view('welcome');
});

Route::group(['prefix'=>'admin', 'middleware'=>'auth.checkrole:admin', 'as'=>'admin.'], function() {
    Route::get('categorias',['as'=> 'categorias.index','uses'=>'CategoriasController@index']);
    Route::get('categorias/create',['as'=> 'categorias.create','uses'=>'CategoriasController@create']);
    Route::post('categorias/store',['as'=> 'categorias.store','uses'=>'CategoriasController@store']);
    Route::get('categorias/edit/{id}',['as'=> 'categorias.edit','uses'=>'CategoriasController@edit']);
    Route::post('categorias/update/{id}',['as'=> 'categorias.update','uses'=>'CategoriasController@update']);

    Route::get('clientes',['as'=> 'clientes.index','uses'=>'ClientesController@index']);
    Route::get('clientes/create',['as'=> 'clientes.create','uses'=>'ClientesController@create']);
    Route::post('clientes/store',['as'=> 'clientes.store','uses'=>'ClientesController@store']);
    Route::get('clientes/edit/{id}',['as'=> 'clientes.edit','uses'=>'ClientesController@edit']);
    Route::post('clientes/update/{id}',['as'=> 'clientes.update','uses'=>'ClientesController@update']);

    Route::get('produtos',['as'=> 'produtos.index','uses'=>'ProdutosController@index']);
    Route::get('produtos/create',['as'=> 'produtos.create','uses'=>'ProdutosController@create']);
    Route::post('produtos/store',['as'=> 'produtos.store','uses'=>'ProdutosController@store']);
    Route::get('produtos/edit/{id}',['as'=> 'produtos.edit','uses'=>'ProdutosController@edit']);
    Route::post('produtos/update/{id}',['as'=> 'produtos.update','uses'=>'ProdutosController@update']);
    Route::get('produtos/destroy/{id}',['as'=> 'produtos.destroy','uses'=>'ProdutosController@destroy']);

    Route::get('pedidos',['as'=> 'pedidos.index','uses'=>'PedidosController@index']);
    Route::get('pedidos/edit/{id}',['as'=> 'pedidos.edit','uses'=>'PedidosController@edit']);
    Route::post('pedidos/update/{id}',['as'=> 'pedidos.update','uses'=>'PedidosController@update']);
    
    Route::get('cupoms', ['as'=>'cupoms.index', 'uses'=>'CupomsController@index']);
    Route::get('cupoms/create',['as'=> 'cupoms.create','uses'=>'CupomsController@create']);
    Route::post('cupoms/store',['as'=> 'cupoms.store','uses'=>'CupomsController@store']);
});

Route::resource('customer', 'CheckoutController');

Route::post('oauth/access_token', function() {
    return Response::json(Authorizer::issueAccessToken());
});

Route::group(['prefix'=>'api', 'middleware'=>'oauth', 'as'=>'api.'], function(){

    Route::group(['prefix'=>'client', 'middleware'=>'oauth.checkrole:cliente', 'as'=>'cliente.'], function(){
        Route::resource('pedidos', 'Api\ClienteCheckoutController', ['except'=>['create','edit', 'destroy']]);
    });

    Route::group(['prefix'=>'deliveryman','middleware'=>'oauth.checkrole:entregador','as'=>'deliveryman.'], function(){
        Route::resource('pedidos', 'Api\EntregadorCheckoutController', ['except'=>['create','edit', 'destroy', 'store']]);
        Route::patch('pedidos/{id}/update-status', ['uses'=>'Api\EntregadorCheckoutController@update', 'as'=>'pedidos.update_status']);
    });

    Route::resource('authenticated', 'TesteController');

});

