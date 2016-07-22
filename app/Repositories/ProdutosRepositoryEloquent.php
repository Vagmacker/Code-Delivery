<?php

namespace CodeDelivery\Repositories;

use CodeDelivery\Presenters\ProductPresenter;
use CodeDelivery\Transformers\ProductTransformer;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeDelivery\Repositories\ProdutosRepository;
use CodeDelivery\Models\Produtos;
use CodeDelivery\Validators\ProdutosValidator;

/**
 * Class ProdutosRepositoryEloquent
 * @package namespace CodeDelivery\Repositories;
 */
class ProdutosRepositoryEloquent extends BaseRepository implements ProdutosRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */

    protected $skipPresenter = true;

    public function lists($column, $key = null)
    {
        return $this->model->lists('id', 'nome', 'preco');
    }

    public function model()
    {
        return Produtos::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function presenter()
    {
        return ProductPresenter::class;
    }
}
