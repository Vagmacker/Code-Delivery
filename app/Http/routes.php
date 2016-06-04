<?php

Route::group(['prefix'=>'admin', 'as'=>'admin.'], function() {
    Route::get('categorias',['as'=> 'categorias.index','uses'=>'CategoriasController@index']);
    Route::get('categorias/create',['as'=> 'categorias.create','uses'=>'CategoriasController@create']);
    Route::post('categorias/store',['as'=> 'categorias.store','uses'=>'CategoriasController@store']);
    Route::get('categorias/edit/{id}',['as'=> 'categorias.edit','uses'=>'CategoriasController@edit']);
    Route::post('categorias/update/{id}',['as'=> 'categorias.update','uses'=>'CategoriasController@update']);

    Route::get('produtos',['as'=> 'produtos.index','uses'=>'ProdutosController@index']);
    Route::get('produtos/create',['as'=> 'produtos.create','uses'=>'ProdutosController@create']);
    Route::post('produtos/store',['as'=> 'produtos.store','uses'=>'ProdutosController@store']);
    Route::get('produtos/edit/{id}',['as'=> 'produtos.edit','uses'=>'ProdutosController@edit']);
    Route::post('produtos/update/{id}',['as'=> 'produtos.update','uses'=>'ProdutosController@update']);
});

