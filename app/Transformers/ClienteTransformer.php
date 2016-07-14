<?php

namespace CodeDelivery\Transformers;

use League\Fractal\TransformerAbstract;
use CodeDelivery\Models\Cliente;

/**
 * Class ClienteTransformer
 * @package namespace CodeDelivery\Transformers;
 */
class ClienteTransformer extends TransformerAbstract
{

    /**
     * Transform the \Cliente entity
     * @param \Cliente $model
     *
     * @return array
     */
    public function transform(Cliente $model)
    {
        return [
            'id'         => (int) $model->id,
            'nome'       => $model->name,
            'email'      => $model->email,
            'numero'     => $model->numero,
            'endereço'   => $model->endereco,
            'postcode'   => $model->postcode,
            'cidade'     => $model->cidade,
            'estado'     => $model->estado,
            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
