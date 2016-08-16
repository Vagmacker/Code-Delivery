<?php

namespace CodeDelivery\Repositories;

use CodeDelivery\Presenters\PedidoPresenter;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeDelivery\Repositories\PedidosRepository;
use CodeDelivery\Models\Pedidos;


/**
 * Class PedidosRepositoryEloquent
 * @package namespace CodeDelivery\Repositories;
 */
class PedidosRepositoryEloquent extends BaseRepository implements PedidosRepository
{
    protected $skipPresenter = true;

    public function getOwnerOrder($id, $entregador)
    {
        $result = $this->model->where('id', $id)
                              ->where('user_deliveryman_id', $entregador)
                              ->first();

        if ($result) {
            return $this->parserResult($result);
        }

        throw (new ModelNotFoundException('Order não existe'))->setModel($this->model());
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Pedidos::class;
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
        return PedidoPresenter::class;
    }
}
