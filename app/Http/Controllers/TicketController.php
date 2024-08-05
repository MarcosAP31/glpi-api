<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TicketService;

class TicketController extends Controller
{
    protected $ticketService;

    public function __construct(TicketService $ticketService)
    {
        $this->ticketService = $ticketService;
    }
    public function index()
    {
        $tickets = $this->ticketService->getAllTickets();
        return $tickets;
    }

    public function getLatest()
    {
        $ticket = $this->ticketService->getLatestTicket();
        if ($ticket) {
            return $ticket;
        } else {
            // If no records are found, return a response indicating that the record is not found
            return response()->json(['message' => 'Ticket not found'], 404);
        }
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $ticket = $this->ticketService->storeTicket($data);
        return response()->json(['message' => 'Ticket stored successfully', 'ticket' => $ticket], 201);
    }

    public function show(int $id)
    {
        $ticket = $this->ticketService->getTicketById($id);
        return $ticket;
    }

    public function update(Request $request, int $id)
    {
        $data = $request->all();
        $ticket = $this->ticketService->updateTicket($data,$id);

        // Return the updated Tickets record
        return response()->json(['message' => 'Ticket updated successfully', 'ticket' => $ticket], 201);
    }

    public function destroy(int $id)
    {
        $this->ticketService->deleteTicket($id);

        // Return a JSON response with a 204 status code
        return new JsonResponse(null, 204);
    }
}
