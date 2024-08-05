<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\EventService;

class EventController extends Controller
{
    protected $eventService;

    public function __construct(EventService $eventService)
    {
        $this->eventService = $eventService;
    }
    public function index()
    {
        $events = $this->eventService->getAllEvents();
        return $events;
    }

    public function getLatest()
    {
        $event = $this->eventService->getLatestEvent();
        if ($event) {
            return $event;
        } else {
            // If no records are found, return a response indicating that the record is not found
            return response()->json(['message' => 'Event not found'], 404);
        }
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $event = $this->eventService->storeEvent($data);
        return response()->json(['message' => 'Event stored successfully', 'event' => $event], 201);
    }

    public function show(int $id)
    {
        $event = $this->eventService->getEventById($id);
        return $event;
    }

    public function getByItemId(int $itemId)
    {
        $event = $this->eventService->getEventByItemId($itemId);
        return $event;
    }

    public function update(Request $request, int $id)
    {
        $data = $request->all();
        $event = $this->eventService->updateEvent($data,$id);

        // Return the updated Events record
        return response()->json(['message' => 'Event updated successfully', 'event' => $event], 201);
    }

    public function destroy(int $id)
    {
        $this->eventService->deleteEvent($id);

        // Return a JSON response with a 204 status code
        return new JsonResponse(null, 204);
    }
}
