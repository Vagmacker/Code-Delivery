<?php

namespace CodeDelivery\Repositories;

use CodeDelivery\Presenters\PedidoPresenter;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeDelivery\Repositories\PedidosRepository;
use CodeDelivery\Models\Pedidos;
use Prettus\Repository\Presenter\ModelFractalPresenter;

//use CodeDelivery\Validators\PedidosValidator;

/**
 * Class PedidosRepositoryEloquent
 * @package namespace CodeDelivery\Repositories;
 */
class PedidosRepositoryEloquent extends BaseRepository implements PedidosRepository
{
    protected $skipPresenter = true;

    public function getOwnerOrder($id, $entregador)
    {
        $result = $this->with(['items', 'cliente','cupom'])->findWhere([
            'id'=>$id,
            'entregador_id'=>$entregador
        ]);
        
        if($result instanceof Collection){
            $result = $result->first();
        } else {
            if (isset($result['data']) && count($result['data']) == 1){
                $result = [
                  'data'=> $result['data'][0]
                ];
            } else{
                throw new ModelNotFoundException('Pedido Não existe');
            }
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

    public function presenter()
    {
        return PedidoPresenter::class;
    }
}
