<?php
/**
 * Created by PhpStorm.
 * User: joao
 * Date: 08/06/16
 * Time: 10:07
 */

namespace CodeDelivery\Services;


use CodeDelivery\Repositories\ClienteRepository;
use CodeDelivery\Repositories\UserRepository;

class ClienteService
{
    /**
     * @var ClienteRepository
     */
    private $clienteRepository;
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(ClienteRepository $clienteRepository, UserRepository $userRepository)
    {

        $this->clienteRepository = $clienteRepository;
        $this->userRepository = $userRepository;
    }

    public function update(array $data, $id)
    {
        $this->clienteRepository->update($data, $id);
        $userId = $this->clienteRepository->find($id, ['user_id'])->user_id;
        $this->userRepository->update($data['user'], $userId);
    }

    public function create(array $data)
    {
        $data['user']['password'] = bcrypt(123456);
        $user = $this->userRepository->create($data['user']);
        $data['user_id'] = $user->id;
        $this->clienteRepository->create($data);
    }
}