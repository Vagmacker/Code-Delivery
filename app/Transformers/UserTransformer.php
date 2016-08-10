<?php

namespace CodeDelivery\Transformers;

use League\Fractal\TransformerAbstract;
use CodeDelivery\Models\User;

/**
 * Class UserTransformer
 * @package namespace CodeDelivery\Transformers;
 */
class UserTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['cliente'];

    /**
     * Transform the \User entity
     * @param \User $model
     *
     * @return array
     */

    public function transform(User $model)
    {
        return [
            'id'         => (int) $model->id,
            'name'       => $model->name,
            'email'      => $model->email,
            'role'       => $model->role
        ];
    }

    public function includeCliente(User $model){
        if($model->cliente) {
            return $this->item($model->cliente(), new ClienteTransformer());
        } else {
            return null;
        }
    }
}
