<?php

namespace CodeDelivery\Transformers;

use League\Fractal\TransformerAbstract;
use CodeDelivery\Models\Produtos;

/**
 * Class ProdutosTransformer
 * @package namespace CodeDelivery\Transformers;
 */
class ProdutosTransformer extends TransformerAbstract
{

    /**
     * Transform the \Produtos entity
     * @param \Produtos $model
     *
     * @return array
     */
    public function transform(Produtos $model)
    {
        return [
            'id'         => (int) $model->id,
            'nome'       => $model->nome,
            'preco'      => $model->preco
        ];
    }
}
