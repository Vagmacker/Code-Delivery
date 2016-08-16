<?php
/**
 * Created by PhpStorm.
 * User: joao
 * Date: 26/06/16
 * Time: 15:48
 */

namespace CodeDelivery\Services;


use CodeDelivery\Models\Pedidos;
use CodeDelivery\Repositories\CupomRepository;
use CodeDelivery\Repositories\PedidosRepository;
use CodeDelivery\Repositories\ProdutosRepository;

class PedidosService
{
    /**
     * @var ProdutosRepository
     */
    private $produtosRepository;
    /**
     * @var CupomRepository
     */
    private $cupomRepository;
    /**
     * @var PedidosRepository
     */
    private $pedidosRepository;

    public function __construct(
        PedidosRepository $pedidosRepository,
        CupomRepository $cupomRepository,
        ProdutosRepository $produtosRepository
    )
    {

        $this->produtosRepository = $produtosRepository;
        $this->cupomRepository = $cupomRepository;
        $this->pedidosRepository = $pedidosRepository;
    }

    public function create(array $data)
    {
        \DB::beginTransaction();
        try{
            $data['status'] = 0;
            
            if(isset($data['cupom_id'])){
                unset($data['cupom_id']);
            }
            
            if(isset($data['cupom_code'])){
                $cupom = $this->cupomRepository->findByField('code', $data['cupom_code'])->first();
                $data['cupom_id'] = $cupom->id;
                $cupom->used = 1;
                $cupom->save();
                unset($data['cupom_code']);
            }

            $items = $data['items'];
            unset($data['items']);

            $pedido = $this->pedidosRepository->create($data);
            $total = 0;

            foreach ($items as $item){
                $item['preco'] = $this->produtosRepository->find($item['produto_id'])->preco;
                $pedido->items()->create($item);
                $total += $item['preco'] * $item['qtd'];
            }

            $pedido->total = $total;
            if(isset($cupom)){
                $pedido->total = $total - $cupom->value;
            }
            $pedido->save();
            \DB::commit();
            return $pedido;
        } catch (\Exception $e){
            \DB::rollback();
            throw $e;
        }

    }

    public function update($id, $entregador, $status)
    {
        $pedidos = $this->pedidosRepository->getOwnerOrder($id, $entregador);

        $pedidos->status = $status;
        if((int)($pedidos->status) == 1 && !$pedidos->hash) {
            $pedidos->hash = md5((new \DateTime())->getTimestamp());
        }
        $pedidos->save();
        return $pedidos;

    }

}