<?php

namespace App\ServicesImpl;

use App\Services\TicketUserService;
use App\Repositories\TicketUserRepository;

class TicketUserServiceImpl implements TicketUserService
{
    protected $ticketUserRepository;

    public function __construct(TicketUserRepository $ticketUserRepository)
    {
        $this->ticketUserRepository = $ticketUserRepository;
    }

    public function getAllTicketUsers()
    {
        return $this->ticketUserRepository->getAll();
    }

    public function getLatestTicketUser()
    {
        return $this->ticketUserRepository->getLatest();
    }

    public function storeTicketUser(array $data)
    {
        return $this->ticketUserRepository->store($data);
    }

    public function getTicketUserById(int $id)
    {
        return $this->ticketUserRepository->getById($id);
    }

    public function getTicketUserByTicketIdAndType(int $ticketId,int $type)
    {
        return $this->ticketUserRepository->getByTicketIdAndType($ticketId,$type);
    }

    public function updateTicketUser(array $data, int $id)
    {
        return $this->ticketUserRepository->update($data, $id);
    }

    public function deleteTicketUser(int $id)
    {
        $this->ticketUserRepository->delete($id);
    }
}