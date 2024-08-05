<?php
namespace App\Repositories;

use App\Models\QueuedNotification;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;

class QueuedNotificationRepository
{
    public function getAll()
    {
        try {
            return QueuedNotification::all();
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
            $lastQueuedNotification = QueuedNotification::latest('id')->first();

            // QueuedNotifications if a record was found
            if ($lastQueuedNotification) {
                return $lastQueuedNotification;
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
            return QueuedNotification::create($data);
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
            $queuedNotification = QueuedNotification::where('id', $id)->firstOrFail();
            return $queuedNotification;
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
            $queuedNotification = QueuedNotification::where('items_id', $itemId)->firstOrFail();
            return $queuedNotification;
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
            // Find the QueuedNotifications record by id
            $queuedNotification = QueuedNotification::where('id', $id)->firstOrFail();

            // Update the QueuedNotifications record with the request data
            $queuedNotification->update($data);

            // Return the updated QueuedNotifications record
            return $queuedNotification;
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
            // Find the QueuedNotifications record by id
            $queuedNotification = QueuedNotification::where('id', $id)->firstOrFail();

            // Delete the QueuedNotifications record
            $queuedNotification->delete();
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