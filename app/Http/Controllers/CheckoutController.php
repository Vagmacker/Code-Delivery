<?php

namespace CodeDelivery\Http\Controllers;

use CodeDelivery\Repositories\PedidosRepository;
use CodeDelivery\Repositories\ProdutosRepository;
use CodeDelivery\Repositories\UserRepository;
use CodeDelivery\Services\PedidosService;
use Illuminate\Http\Request;

use CodeDelivery\Http\Requests;
use CodeDelivery\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
    /**
     * @var PedidosService
     */
    private $service;

    public function __construct(
        PedidosRepository $pedidosRepository,
        UserRepository $userRepository,
        ProdutosRepository $produtosRepository,
        PedidosService $service
    )
    {

        $this->produtosRepository = $produtosRepository;
        $this->userRepository = $userRepository;
        $this->pedidosRepository = $pedidosRepository;
        $this->service = $service;
        //$this->middleware('auth.checkrole:client');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clienteId = $this->userRepository->find(Auth::user()->id)->cliente->id;
        $pedidos = $this->pedidosRepository->scopeQuery(function ($query) use ($clienteId){
            return $query->where('cliente_id', '=', $clienteId);
        })->paginate();

        return view('customer.pedidos.index', compact('pedidos'));
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
        $data = $request->all();
        $clienteId = $this->userRepository->find(Auth::user()->id)->cliente->id;
        $data['cliente_id'] = $clienteId;
        $this->service->create($data);

        return redirect()->route('customer.index');
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
