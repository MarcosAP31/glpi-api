<?php
namespace App\Repositories;

use App\Models\Event;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;

class EventRepository
{
    public function getAll()
    {
        try {
            return Event::all();
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

    public function getLatest()
    {
        try {
            // Find the last record and return it
            $lastEvent = Event::latest('id')->first();

            // Events if a record was found
            if ($lastEvent) {
                return $lastEvent;
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
            return Event::create($data);
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
            $event = Event::where('id', $id)->firstOrFail();
            return $event;
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

    public function getByItemId(int $itemId)
    {
        try {
            $event = Event::where('items_id', $itemId)->firstOrFail();
            return $event;
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
            // Find the Events record by id
            $event = Event::where('id', $id)->firstOrFail();

            // Update the Events record with the request data
            $event->update($data);

            // Return the updated Events record
            return $event;
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
            // Find the Events record by id
            $event = Event::where('id', $id)->firstOrFail();

            // Delete the Events record
            $event->delete();
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