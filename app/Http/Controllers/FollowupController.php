<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FollowupService;

class FollowupController extends Controller
{
    protected $followupService;

    public function __construct(FollowupService $followupService)
    {
        $this->followupService = $followupService;
    }
    public function index()
    {
        $followups = $this->followupService->getAllFollowups();
        return $followups;
    }

    public function getLatest()
    {
        $followup = $this->followupService->getLatestFollowup();
        if ($followup) {
            return $followup;
        } else {
            // If no records are found, return a response indicating that the record is not found
            return response()->json(['message' => 'Followup not found'], 404);
        }
    }

    public function getLatestByDate()
    {
        $followup = $this->followupService->getLatestFollowupByDate();
        if ($followup) {
            return $followup;
        } else {
            // If no records are found, return a response indicating that the record is not found
            return response()->json(['message' => 'Followup not found'], 404);
        }
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $followup = $this->followupService->storeFollowup($data);
        return response()->json(['message' => 'Followup stored successfully', 'followup' => $followup], 201);
    }

    public function show(int $id)
    {
        $followup = $this->followupService->getFollowupById($id);
        return $followup;
    }

    public function update(Request $request, int $id)
    {
        $data = $request->all();
        $followup = $this->followupService->updateFollowup($data,$id);

        // Return the updated Followups record
        return response()->json(['message' => 'Followup updated successfully', 'followup' => $followup], 201);
    }

    public function destroy(int $id)
    {
        $this->followupService->deleteFollowup($id);

        // Return a JSON response with a 204 status code
        return new JsonResponse(null, 204);
    }

    public function sendNotificationAuthor()
    {
        $followup = $this->followupService->sendNotificationAuthor();
        return response()->json(['followup' => $followup], 200);
    }
}
