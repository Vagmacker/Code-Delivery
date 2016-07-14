<?php

namespace CodeDelivery\Presenters;

use CodeDelivery\Transformers\PedidoTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class PedidoPresenter
 *
 * @package namespace CodeDelivery\Presenters;
 */
class PedidoPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new PedidoTransformer();
    }
}
