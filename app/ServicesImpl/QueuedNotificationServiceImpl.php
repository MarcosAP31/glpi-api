<?php

namespace App\ServicesImpl;

use App\Services\QueuedNotificationService;
use App\Repositories\QueuedNotificationRepository;

class QueuedNotificationServiceImpl implements QueuedNotificationService
{
    protected $queuedNotificationRepository;

    public function __construct(QueuedNotificationRepository $queuedNotificationRepository)
    {
        $this->queuedNotificationRepository = $queuedNotificationRepository;
    }

    public function getAllQueuedNotifications()
    {
        return $this->queuedNotificationRepository->getAll();
    }

    public function getLatestQueuedNotification()
    {
        return $this->queuedNotificationRepository->getLatest();
    }

    public function storeQueuedNotification(array $data)
    {
        return $this->queuedNotificationRepository->store($data);
    }

    public function getQueuedNotificationById($id)
    {
        return $this->queuedNotificationRepository->getById($id);
    }

    public function getQueuedNotificationByItemId(int $itemId){
        return $this->queuedNotificationRepository->getByItemId($itemId);
    }

    public function updateQueuedNotification(array $data, $id)
    {
        return $this->queuedNotificationRepository->update($data, $id);
    }

    public function deleteQueuedNotification($id)
    {
        $this->queuedNotificationRepository->delete($id);
    }
}