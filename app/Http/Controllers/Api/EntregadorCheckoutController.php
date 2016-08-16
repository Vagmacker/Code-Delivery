<?php

namespace CodeDelivery\Http\Controllers\Api;

use CodeDelivery\Models\Geo;
use CodeDelivery\Repositories\GeoRepository;
use CodeDelivery\Repositories\PedidosRepository;
use CodeDelivery\Repositories\UserRepository;
use CodeDelivery\Services\PedidosService;
use Illuminate\Http\Request;

use CodeDelivery\Http\Requests;
use CodeDelivery\Http\Controllers\Controller;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class EntregadorCheckoutController extends Controller
{
    /**
     * @var PedidosRepository
     */
    private $pedidosRepository;
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var PedidosService
     */
    private $service;

    private $with = ['cliente', 'cupom', 'items'];
    /**
     * @var GeoRepository
     */
    private $geoRepository;

    public function __construct(
        PedidosRepository $pedidosRepository,
        UserRepository $userRepository,
        PedidosService $service,
        GeoRepository $geoRepository
    )
    {

        $this->pedidosRepository = $pedidosRepository;
        $this->userRepository = $userRepository;
        $this->service = $service;
        $this->geoRepository = $geoRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Authorizer::getResourceOwnerId();
        $pedidos = $this->pedidosRepository->skipPresenter(false)->with($this->with)->scopeQuery(function ($query) use ($id){
            return $query->where('entregador_id', '=', $id);
        })->paginate();

        return $pedidos;
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
        $entregador = Authorizer::getResourceOwnerId();
        $result = $this->pedidosRepository->skipPresenter(false)->getOwnerOrder($id, $entregador);
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
        $entregador = Authorizer::getResourceOwnerId();
        $status = $request->get('status');
        return $this->service->update($id, $entregador, $status);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function geo(Request $request, $id, Geo $geo)
    {
        $entregador = Authorizer::getResourceOwnerId();
        $order = $this->pedidosRepository->getOwnerOrder($id, $entregador);
        $geo->latitude = $request->get('latitude');
        $geo->longitude = $request->get('longitude');
        return $geo;
    }
}
