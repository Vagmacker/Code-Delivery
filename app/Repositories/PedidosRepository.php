<?php

namespace CodeDelivery\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface PedidosRepository
 * @package namespace CodeDelivery\Repositories;
 */
interface PedidosRepository extends RepositoryInterface
{
    public function getOwnerOrder($id, $entregador);
}
