<?php

namespace CodeDelivery\Http\Controllers;

use CodeDelivery\Repositories\PedidosRepository;
use CodeDelivery\Repositories\ProdutosRepository;
use CodeDelivery\Repositories\UserRepository;
use Illuminate\Http\Request;

use CodeDelivery\Http\Requests;
use CodeDelivery\Http\Controllers\Controller;

class CheckoutController extends Controller
{
    /**
     * @var ProdutosRepository
     */
    private $produtosRepository;
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var PedidosRepository
     */
    private $pedidosRepository;

    public function __construct(
        PedidosRepository $pedidosRepository,
        UserRepository $userRepository,
        ProdutosRepository $produtosRepository
    )
    {

        $this->produtosRepository = $produtosRepository;
        $this->userRepository = $userRepository;
        $this->pedidosRepository = $pedidosRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$produtos = $this->produtosRepository->lists('id','nome', 'preco');
        $produtos = $this->produtosRepository->all();
        return view('customer.pedidos.create', compact('produtos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
