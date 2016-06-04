<?php

namespace CodeDelivery\Http\Controllers;

use CodeDelivery\Http\Requests\AdminCategoriaRequest;
use CodeDelivery\Repositories\CategoriaRepository;
use Illuminate\Http\Request;

use CodeDelivery\Http\Requests;
use CodeDelivery\Http\Controllers\Controller;

class CategoriasController extends Controller
{
    private $repository;

    public function __construct(CategoriaRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $categorias = $this->repository->paginate(5);

        return view('Delivery.Categorias.index', compact('categorias'));
    }
    
    public function create()
    {
        return view('Delivery.Categorias.create');
    }
    
    public function store(AdminCategoriaRequest $request)
    {
        $data = $request->all();
        $this->repository->create($data);

        return redirect()->route('admin.categorias.index');
    }
    
    public function edit($id)
    {
        $categoria = $this->repository->find($id);
        return view('Delivery.Categorias.edit', compact('categoria'));
    }
    
    public function update(AdminCategoriaRequest $request, $id)
    {
        $data = $request->all();
        $this->repository->update($data, $id);

        return redirect()->route('admin.categorias.index');
    }
}
