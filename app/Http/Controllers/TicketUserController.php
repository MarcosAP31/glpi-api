<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TicketUserService;

class TicketUserController extends Controller
{
    protected $ticketUserService;

    public function __construct(TicketUserService $ticketUserService)
    {
        $this->ticketUserService = $ticketUserService;
    }
    public function index()
    {
        $ticketUsers = $this->ticketUserService->getAllTicketUsers();
        return $ticketUsers;
    }

    public function getLatest()
    {
        $ticketUser = $this->ticketUserService->getLatestTicketUser();
        if ($ticketUser) {
            return $ticketUser;
        } else {
            // If no records are found, return a response indicating that the record is not found
            return response()->json(['message' => 'TicketUser not found'], 404);
        }
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $ticketUser = $this->ticketUserService->storeTicketUser($data);
        return response()->json(['message' => 'TicketUser stored successfully', 'ticketUser' => $ticketUser], 201);
    }

    public function show(int $id)
    {
        $ticketUser = $this->ticketUserService->getTicketUserById($id);
        return $ticketUser;
    }

    public function getByTicketIdAndType(int $ticketId,int $type)
    {
        $ticketUser = $this->ticketUserService->getTicketUserByTicketIdAndType($ticketId,$type);
        return $ticketUser;
    }

    public function update(Request $request, int $id)
    {
        $data = $request->all();
        $ticketUser = $this->ticketUserService->updateTicketUser($data,$id);

        // Return the updated TicketUsers record
        return response()->json(['message' => 'TicketUser updated successfully', 'ticketUser' => $ticketUser], 201);
    }

    public function destroy(int $id)
    {
        $this->ticketUserService->deleteTicketUser($id);

        // Return a JSON response with a 204 status code
        return new JsonResponse(null, 204);
    }
}
