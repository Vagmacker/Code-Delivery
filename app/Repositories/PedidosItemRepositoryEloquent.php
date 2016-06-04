<?php

namespace CodeDelivery\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeDelivery\Repositories\PedidosItemRepository;
use CodeDelivery\Models\PedidosItem;
use CodeDelivery\Validators\PedidosItemValidator;

/**
 * Class PedidosItemRepositoryEloquent
 * @package namespace CodeDelivery\Repositories;
 */
class PedidosItemRepositoryEloquent extends BaseRepository implements PedidosItemRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return PedidosItem::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
