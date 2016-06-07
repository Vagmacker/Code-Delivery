<?php

namespace CodeDelivery\Http\Controllers;

use CodeDelivery\Http\Requests\AdminProdutoRequest;
use CodeDelivery\Repositories\CategoriaRepository;
use CodeDelivery\Repositories\ProdutosRepository;
use Illuminate\Http\Request;
use CodeDelivery\Http\Requests;
use CodeDelivery\Http\Controllers\Controller;

class ProdutosController extends Controller
{
    private $repository;
    /**
     * @var CategoriaRepository
     */
    private $categoriaRepository;

    public function __construct(ProdutosRepository $repository, CategoriaRepository $categoriaRepository)
    {
        $this->repository = $repository;
        $this->categoriaRepository = $categoriaRepository;
    }

    public function index()
    {
        $produtos = $this->repository->paginate(10);

        return view('Delivery.Produtos.index', compact('produtos'));
    }

    public function create()
    {
        $categorias = $this->categoriaRepository->lists('name', 'id');
        return view('Delivery.Produtos.create', compact('categorias'));
    }

    public function store(AdminProdutoRequest $request)
    {
        $data = $request->all();
        $this->repository->create($data);
        return redirect()->route('admin.produtos.index');
    }

    public function edit($id)
    {
        $produtos = $this->repository->find($id);
        $categorias = $this->categoriaRepository->lists('name', 'id');
        return view('Delivery.Produtos.edit', compact('produtos', 'categorias'));
    }

    public function update(AdminProdutoRequest $request, $id)
    {
        $data = $request->all();
        $this->repository->update($data, $id);

        return redirect()->route('admin.produtos.index');
    }

    public function destroy($id)
    {
        $this->repository->delete($id);
        
        return redirect()->route('admin.produtos.index');
    }
}
