<?php

namespace App\Services;

interface EventService
{
    public function getAllEvents();
    
    public function getLatestEvent();
    
    public function storeEvent(array $data);

    public function getEventById(int $id);

    public function getEventByItemId(int $itemId);

    public function updateEvent(array $data, int $id);

    public function deleteEvent(int $id);
}