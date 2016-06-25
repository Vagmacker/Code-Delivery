<?php

namespace CodeDelivery\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Produtos extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'categoria_id',
        'nome',
        'descricao',
        'preco'
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
    
}
