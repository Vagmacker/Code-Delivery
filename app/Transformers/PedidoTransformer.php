<?php

namespace CodeDelivery\Transformers;

use CodeDelivery\Models\Pedidos;
use League\Fractal\TransformerAbstract;

/**
 * Class PedidoTransformer
 * @package namespace CodeDelivery\Transformers;
 */
class PedidoTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['cupom','items', 'cliente', 'entregador'];

    /**
     * Transform the \Pedido entity
     * @param \Pedidos $model
     *
     * @return array
     */
    public function transform(Pedidos $model)
    {
        return [
            'total'      => (float) $model->total,
            'status'     => (int) $model->status,
            'created_at' => $model->created_at
        ];
    }

    public function includeCliente(Pedidos $model)
    {
        return $this->item($model->cliente, new ClienteTransformer());
    }

    public function includeEntregador(Pedidos $model)
    {
        return $this->item($model->entregador, new EntredagorTransformer());
    }

    public function includeCupom(Pedidos $model)
    {
        if(!$model->cupom){
            return null;
        }
        return $this->item($model->cupom, new CupomTransformer());
    }

    public function includeItems(Pedidos $model)
    {
        return $this->collection($model->items, new PedidosItemTransformer());
    }
}
