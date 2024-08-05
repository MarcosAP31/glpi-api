<?php

namespace App\Services;

interface TicketUserService
{
    public function getAllTicketUsers();
    
    public function getLatestTicketUser();
    
    public function storeTicketUser(array $data);

    public function getTicketUserById(int $id);

    public function getTicketUserByTicketIdAndType(int $ticketId,int $type);

    public function updateTicketUser(array $data, int $id);

    public function deleteTicketUser(int $id);
}