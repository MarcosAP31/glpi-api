<?php

namespace App\ServicesImpl;

use App\Services\TicketService;
use App\Repositories\TicketRepository;

class TicketServiceImpl implements TicketService
{
    protected $ticketRepository;

    public function __construct(TicketRepository $ticketRepository)
    {
        $this->ticketRepository = $ticketRepository;
    }

    public function getAllTickets()
    {
        return $this->ticketRepository->getAll();
    }

    public function getLatestTicket()
    {
        return $this->ticketRepository->getLatest();
    }

    public function storeTicket(array $data)
    {
        return $this->ticketRepository->store($data);
    }

    public function getTicketById(int $id)
    {
        return $this->ticketRepository->getById($id);
    }

    public function updateTicket(array $data, int $id)
    {
        return $this->ticketRepository->update($data, $id);
    }

    public function deleteTicket(int $id)
    {
        $this->ticketRepository->delete($id);
    }
}