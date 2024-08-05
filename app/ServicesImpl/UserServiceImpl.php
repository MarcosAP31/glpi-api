<?php

namespace App\ServicesImpl;

use App\Services\UserService;
use App\Repositories\UserRepository;

class UserServiceImpl implements UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAllUsers()
    {
        return $this->userRepository->getAll();
    }

    public function getLatestUser()
    {
        return $this->userRepository->getLatest();
    }

    public function storeUser(array $data)
    {
        return $this->userRepository->store($data);
    }

    public function getUserById(int $id)
    {
        return $this->userRepository->getById($id);
    }

    public function updateUser(array $data, int $id)
    {
        return $this->userRepository->update($data, $id);
    }

    public function deleteUser(int $id)
    {
        $this->userRepository->delete($id);
    }
}