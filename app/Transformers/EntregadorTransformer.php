<?php

namespace CodeDelivery\Transformers;

use CodeDelivery\Models\User;
use League\Fractal\TransformerAbstract;
use CodeDelivery\Models\Entregador;

/**
 * Class EntregadorTransformer
 * @package namespace CodeDelivery\Transformers;
 */
class EntregadorTransformer extends TransformerAbstract
{

    /**
     * Transform the \Entregador entity
     * @param \Entregador $model
     *
     * @return array
     */
    public function transform(User $model)
    {
        return [
            'id'         => (int) $model->id,
            'name'       => $model->name,
            'email'      => $model->email
        ];
    }
}
