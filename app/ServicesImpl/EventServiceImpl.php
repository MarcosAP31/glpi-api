<?php

namespace App\ServicesImpl;

use App\Services\EventService;
use App\Repositories\EventRepository;

class EventServiceImpl implements EventService
{
    protected $eventRepository;

    public function __construct(EventRepository $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

    public function getAllEvents()
    {
        return $this->eventRepository->getAll();
    }

    public function getLatestEvent()
    {
        return $this->eventRepository->getLatest();
    }

    public function storeEvent(array $data)
    {
        return $this->eventRepository->store($data);
    }

    public function getEventById(int $id)
    {
        return $this->eventRepository->getById($id);
    }

    public function getEventByItemId(int $itemId){
        return $this->eventRepository->getByItemId($itemId);
    }

    public function updateEvent(array $data, int $id)
    {
        return $this->eventRepository->update($data, $id);
    }

    public function deleteEvent(int $id)
    {
        $this->eventRepository->delete($id);
    }
}