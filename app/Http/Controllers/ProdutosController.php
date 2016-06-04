<?php

namespace CodeDelivery\Http\Controllers;

use CodeDelivery\Http\Requests\AdminProdutoRequest;
use CodeDelivery\Repositories\ProdutosRepository;
use Illuminate\Http\Request;
use CodeDelivery\Http\Requests;
use CodeDelivery\Http\Controllers\Controller;

class ProdutosController extends Controller
{
    private $repository;

    public function __construct(ProdutosRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $produtos = $this->repository->paginate(5);

        return view('Delivery.Produtos.index', compact('produtos'));
    }

    public function create()
    {
        return view('Delivery.Produtos.create');
    }

    public function store(AdminCategoriaRequest $request)
    {
        $data = $request->all();
        $this->repository->create($data);

        return redirect()->route('admin.produtos.index');
    }

    public function edit($id)
    {
        $produtos = $this->repository->find($id);
        return view('Delivery.Produtos.edit', compact('produtos'));
    }

    public function update(AdminCategoriaRequest $request, $id)
    {
        $data = $request->all();
        $this->repository->update($data, $id);

        return redirect()->route('admin.produtos.index');
    }
}
