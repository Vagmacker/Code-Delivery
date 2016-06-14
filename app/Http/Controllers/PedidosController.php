<?php

namespace CodeDelivery\Http\Controllers;

use CodeDelivery\Repositories\PedidosRepository;
use CodeDelivery\Repositories\UserRepository;
use Illuminate\Http\Request;

use CodeDelivery\Http\Requests;
use CodeDelivery\Http\Controllers\Controller;

class PedidosController extends Controller
{
    /**
     * @var PedidosRepository
     */
    private $pedidosRepository;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public  function __construct(PedidosRepository $pedidosRepository)
    {

        $this->pedidosRepository = $pedidosRepository;
    }

    public function index()
    {
        $pedidos = $this->pedidosRepository->paginate(10);
        return view('Delivery.Pedidos.index', compact('pedidos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    public function edit($id, UserRepository $userRepository)
    {
        $status = [0=>'Pendente', 1=>'A caminho', 2=>'Entregue', 3=>'Cancelado'];
        $pedidos = $this->pedidosRepository->find($id);
        $entregador = $userRepository->getEntregador();
        return view('Delivery.Pedidos.edit', compact('pedidos', 'status', 'entregador'));
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
        $all = $request->all();
        $this->pedidosRepository->update($all, $id);

        return redirect()->route('admin.pedidos.index');
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
