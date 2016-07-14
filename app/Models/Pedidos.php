<?php

namespace CodeDelivery\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Pedidos extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'cliente_id',
        'entregador_id',
        'total',
        'status',
        'cupom_id'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
    public function cupom()
    {
        return $this->belongsTo(Cupom::class);
    }
    public function items()
    {
        return $this->hasMany(PedidosItem::class);
    }

    public function entregador()
    {
        return $this->belongsTo(User::class, 'entregador_id', 'id');
    }

    public function produtos()
    {
        return $this->hasMany(Produtos::class);
    }

}
