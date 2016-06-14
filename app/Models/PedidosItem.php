<?php

namespace CodeDelivery\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class PedidosItem extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'produto_id',
        'pedido_id',
        'valor',
        'qtd'
    ];

    public function produto()
    {
        return $this->belongsTo(Produtos::class);
    }

    public function pedido()
    {
        return $this->belongsTo(Pedidos::class);
    }

}
