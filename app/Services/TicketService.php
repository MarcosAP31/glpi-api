<?php

namespace App\Services;

interface TicketService
{
    public function getAllTickets();
    
    public function getLatestTicket();
    
    public function storeTicket(array $data);

    public function getTicketById(int $id);

    public function updateTicket(array $data, int $id);

    public function deleteTicket(int $id);
}