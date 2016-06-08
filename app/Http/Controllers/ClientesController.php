<?php

namespace CodeDelivery\Http\Controllers;

use CodeDelivery\Repositories\ClienteRepository;
use CodeDelivery\Services\ClienteService;
use Illuminate\Http\Request;
use CodeDelivery\Http\Requests\AdminClientesRequest;
use CodeDelivery\Http\Requests;
use CodeDelivery\Http\Controllers\Controller;

class ClientesController extends Controller
{
    private $repository;
    /**
     * @var ClienteService
     */
    private $clienteService;

    public function __construct(ClienteRepository $repository, ClienteService $clienteService)
    {
        $this->repository = $repository;
        $this->clienteService = $clienteService;
    }

    public function index()
    {
        $clientes = $this->repository->paginate(5);

        return view('Delivery.Clientes.index', compact('clientes'));
    }
    
    public function create()
    {
        return view('Delivery.Clientes.create');
    }
    
    public function store(AdminClientesRequest $request)
    {
        $data = $request->all();
        $this->clienteService->create($data);

        return redirect()->route('admin.clientes.index');
    }
    
    public function edit($id)
    {
        $cliente = $this->repository->find($id);
        return view('Delivery.Clientes.edit', compact('cliente'));
    }
    
    public function update(AdminClientesRequest $request, $id)
    {
        $data = $request->all();
        $this->clienteService->update($data, $id);

        return redirect()->route('admin.clientes.index');
    }
}
