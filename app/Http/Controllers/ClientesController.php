<?php

namespace CodeDelivery\Http\Controllers;

use CodeDelivery\Repositories\ClienteRepository;
use Illuminate\Http\Request;
use CodeDelivery\Http\Requests\AdminClientesRequest;
use CodeDelivery\Http\Requests;
use CodeDelivery\Http\Controllers\Controller;

class ClientesController extends Controller
{
    private $repository;

    public function __construct(ClienteRepository $repository)
    {
        $this->repository = $repository;
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
        $this->repository->create($data);

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
        $this->repository->update($data, $id);

        return redirect()->route('admin.clientes.index');
    }
}
