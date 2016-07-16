<?php

namespace CodeDelivery\Transformers;

use League\Fractal\TransformerAbstract;
use CodeDelivery\Models\PedidosItem;

/**
 * Class PedidosItemTransformer
 * @package namespace CodeDelivery\Transformers;
 */
class PedidosItemTransformer extends TransformerAbstract
{

    protected $defaultIncludes = ['produtos'];

    /**
     * Transform the \PedidosItem entity
     * @param \PedidosItem $model
     *
     * @return array
     */
    public function transform(PedidosItem $model)
    {
        return [
            'id'         => (int) $model->id,
            'valor'      => (float) $model->valor,
            'qtd'        => (int) $model->qtd
        ];
    }

    public function includeProdutos(PedidosItem $model)
    {
        if(!$model->produtos){
            return null;
        }
        return $this->item($model->produtos, new ProdutosTransformer());
    }
}
