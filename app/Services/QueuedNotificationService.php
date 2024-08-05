<?php

namespace App\Services;

interface QueuedNotificationService
{
    public function getAllQueuedNotifications();
    
    public function getLatestQueuedNotification();
    
    public function storeQueuedNotification(array $data);

    public function getQueuedNotificationById(int $id);
    
    public function getQueuedNotificationByItemId(int $itemId);

    public function updateQueuedNotification(array $data, int $id);

    public function deleteQueuedNotification(int $id);
}