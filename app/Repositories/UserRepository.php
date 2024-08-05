<?php
namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;

class UserRepository
{
    public function getAll()
    {
        try {
            return User::all();
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
            $lastUsers = User::latest('id')->first();

            // Users if a record was found
            if ($lastUsers) {
                return $lastUsers;
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
            return User::create($data);
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
            $user = User::where('id', $id)->firstOrFail();
            return $user;
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
            // Find the Users record by id
            $user = User::where('id', $id)->firstOrFail();

            // Update the Users record with the request data
            $user->update($data);

            // Return the updated Users record
            return $user;
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
            // Find the Users record by id
            $user = User::where('id', $id)->firstOrFail();

            // Delete the Users record
            $user->delete();
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