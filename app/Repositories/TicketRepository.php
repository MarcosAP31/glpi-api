<?php
namespace App\Repositories;

use App\Models\Ticket;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;

class TicketRepository
{
    public function getAll()
    {
        try {
            return Ticket::all();
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            // Captura y maneja los errores del cliente HTTP
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            return response()->json(['error' => 'Request failed', 'details' => $responseBodyAsString], $response->getStatusCode());
        }

    }

    public function getLatest()
    {
        try {
            // Find the last record and return it
            $lastTicket = Ticket::latest('id')->first();

            // Tickets if a record was found
            if ($lastTicket) {
                return $lastTicket;
            } else {
                // If no records are found, return a response indicating that the table is empty
                throw new ModelNotFoundException('No records found');
            }
        } catch (\Exception $e) {
            // Log the error details
            Log::error('Error occurred: ' . $e->getMessage());

            // Return a custom error response
            return response()->json([
                'error' => 'An error occurred. Please try again later.',
                'details' => $e->getMessage() // Include the error details in the response
            ], 500);
        }

    }

    public function store(array $data)
    {
        try {
            return Ticket::create($data);
        } catch (\Exception $e) {
            // Log the error details
            Log::error('Error occurred: ' . $e->getMessage());

            // Return a custom error response
            return response()->json([
                'error' => 'An error occurred. Please try again later.',
                'details' => $e->getMessage() // Include the error details in the response
            ], 500);
        }

    }

    public function getById(int $id)
    {
        try {
            $ticket = Ticket::where('id', $id)->firstOrFail();
            return $ticket;
        } catch (\Exception $e) {
            // Log the error details
            Log::error('Error occurred: ' . $e->getMessage());

            // Return a custom error response
            return response()->json([
                'error' => 'An error occurred. Please try again later.',
                'details' => $e->getMessage() // Include the error details in the response
            ], 500);
        }

    }

    public function update(array $data, int $id)
    {
        try {
            // Find the Tickets record by id
            $ticket = Ticket::where('id', $id)->firstOrFail();

            // Update the Tickets record with the request data
            $ticket->update($data);

            // Return the updated Tickets record
            return $ticket;
        } catch (\Exception $e) {
            // Log the error details
            Log::error('Error occurred: ' . $e->getMessage());

            // Return a custom error response
            return response()->json([
                'error' => 'An error occurred. Please try again later.',
                'details' => $e->getMessage() // Include the error details in the response
            ], 500);
        }

    }

    public function delete(int $id)
    {
        try {
            // Find the Tickets record by id
            $ticket = Ticket::where('id', $id)->firstOrFail();

            // Delete the Tickets record
            $ticket->delete();
        } catch (\Exception $e) {
            // Log the error details
            Log::error('Error occurred: ' . $e->getMessage());

            // Return a custom error response
            return response()->json([
                'error' => 'An error occurred. Please try again later.',
                'details' => $e->getMessage() // Include the error details in the response
            ], 500);
        }


    }
}
?>