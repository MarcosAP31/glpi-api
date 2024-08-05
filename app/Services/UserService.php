<?php

namespace App\Services;

interface UserService
{
    public function getAllUsers();
    
    public function getLatestUser();
    
    public function storeUser(array $data);

    public function getUserById(int $id);

    public function updateUser(array $data, int $id);

    public function deleteUser(int $id);
}