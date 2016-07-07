<?php

namespace CodeDelivery\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeDelivery\Repositories\PedidosRepository;
use CodeDelivery\Models\Pedidos;
//use CodeDelivery\Validators\PedidosValidator;

/**
 * Class PedidosRepositoryEloquent
 * @package namespace CodeDelivery\Repositories;
 */
class PedidosRepositoryEloquent extends BaseRepository implements PedidosRepository
{

    public function getId($id, $entregador)
    {
        $result = $this->with(['items', 'cliente','cupom'])->findWhere([
            'id'=>$id,
            'entregador_id'=>$entregador
        ]);
        

        $result = $result->first();
        if($result) {
            $result->items->each(function ($item) {
                $item->produto;
            });
        }
        
        return $result;
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
}
