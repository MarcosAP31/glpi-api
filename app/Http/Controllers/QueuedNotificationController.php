<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\QueuedNotificationService;

class QueuedNotificationController extends Controller
{
    protected $queuedNotificationService;

    public function __construct(QueuedNotificationService $queuedNotificationService)
    {
        $this->queuedNotificationService = $queuedNotificationService;
    }
    public function index()
    {
        $queuedNotifications = $this->queuedNotificationService->getAllQueuedNotifications();
        return $queuedNotifications;
    }

    public function getLatest()
    {
        $queuedNotification = $this->queuedNotificationService->getLatestQueuedNotification();
        if ($queuedNotification) {
            return $queuedNotification;
        } else {
            // If no records are found, return a response indicating that the record is not found
            return response()->json(['message' => 'QueuedNotification not found'], 404);
        }
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $queuedNotification = $this->queuedNotificationService->storeQueuedNotification($data);
        return response()->json(['message' => 'QueuedNotification stored successfully', 'queuedNotification' => $queuedNotification], 201);
    }

    public function show(int $id)
    {
        $queuedNotification = $this->queuedNotificationService->getQueuedNotificationById($id);
        return $queuedNotification;
    }

    public function getByItemId(int $itemId)
    {
        $queuedNotification = $this->queuedNotificationService->getQueuedNotificationByItemId($itemId);
        return $queuedNotification;
    }

    public function update(Request $request, int $id)
    {
        $data = $request->all();
        $queuedNotification = $this->queuedNotificationService->updateQueuedNotification($data,$id);

        // Return the updated QueuedNotifications record
        return response()->json(['message' => 'QueuedNotification updated successfully', 'queuedNotification' => $queuedNotification], 201);
    }

    public function destroy(int $id)
    {
        $this->queuedNotificationService->deleteQueuedNotification($id);

        // Return a JSON response with a 204 status code
        return new JsonResponse(null, 204);
    }
}
