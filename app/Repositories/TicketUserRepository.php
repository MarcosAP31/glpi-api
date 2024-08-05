<?php
namespace App\Repositories;
use Exception;
use App\Models\TicketUser;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;

class TicketUserRepository
{
    public function getAll()
    {
        try {
            return TicketUser::all();
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
            $lastTicketUser = TicketUser::latest('id')->first();

            // TicketUsers if a record was found
            if ($lastTicketUser) {
                return $lastTicketUser;
            } else {
                // If no records are found, return a response indicating that the table is empty
                throw new ModelNotFoundException('No records found');
            }
        } catch (Exception $e) {
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
            return TicketUser::create($data);
        } catch (Exception $e) {
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
            $ticketUser = TicketUser::where('id', $id)->firstOrFail();
            return $ticketUser;
        } catch (Exception $e) {
            // Log the error details
            Log::error('Error occurred: ' . $e->getMessage());

            // Return a custom error response
            return response()->json([
                'error' => 'An error occurred. Please try again later.',
                'details' => $e->getMessage() // Include the error details in the response
            ], 500);
        }

    }

    public function getByTicketIdAndType(int $ticketUserId,int $type)
    {
        try {
        $ticketUser = TicketUser::where('tickets_id', $ticketUserId)->where('type', $type)->orderBy('ID', 'desc')->firstOrFail();
            return $ticketUser;
        } catch (Exception $e) {
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
            // Find the TicketUsers record by id
            $ticketUser = TicketUser::where('id', $id)->firstOrFail();

            // Update the TicketUsers record with the request data
            $ticketUser->update($data);

            // Return the updated TicketUsers record
            return $ticketUser;
        } catch (Exception $e) {
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
            // Find the TicketUsers record by id
            $ticketUser = TicketUser::where('id', $id)->firstOrFail();

            // Delete the TicketUsers record
            $ticketUser->delete();
        } catch (Exception $e) {
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