<?php
namespace App\Repositories;

use Exception;
use App\Models\Followup;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;

class FollowupRepository
{
    protected $ticketRepository, $eventRepository, $queuedNotificationRepository, $userRepository;

    public function __construct(TicketRepository $ticketRepository, EventRepository $eventRepository, QueuedNotificationRepository $queuedNotificationRepository, UserRepository $userRepository)
    {
        $this->ticketRepository = $ticketRepository;
        $this->eventRepository = $eventRepository;
        $this->queuedNotificationRepository = $queuedNotificationRepository;
        $this->userRepository = $userRepository;
    }

    public function getAll()
    {
        try {
            return Followup::all();
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

    public function getLatest()
    {
        try {
            // Find the last record and return it
            $lastFollowup = Followup::latest('id')->first();

            // Followups if a record was found
            if ($lastFollowup) {
                return $lastFollowup;
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

    public function getLatestByDate()
    {
        try {
            // Find the record with the most recent date
            $lastFollowup = Followup::orderBy('date', 'desc')->first();

            // If a record was found, return it
            if ($lastFollowup) {
                return $lastFollowup;
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
            return Followup::create($data);
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
            $followup = Followup::where('id', $id)->firstOrFail();
            return $followup;
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
            // Find the Followups record by id
            $followup = Followup::where('id', $id)->firstOrFail();

            // Update the Followups record with the request data
            $followup->update($data);

            // Return the updated Followups record
            return $followup;
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
            // Find the Followups record by id
            $followup = Followup::where('id', $id)->firstOrFail();

            // Delete the Followups record
            $followup->delete();
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

    public function sendNotificationAuthor()
    {
        try {
            $followup = $this->getLatestByDate();
            $ticket = $this->ticketRepository->getById($followup->items_id);
            $queuedNotification = $this->queuedNotificationRepository->getByItemId($followup->items_id);
            $user = $this->userRepository->getById($ticket->users_id_recipient);
            $fullName = $user->firstname . $user->realname;
            $newString = preg_replace('/\s+/', '', $queuedNotification->body_text);
            $textAfter = '';
            // Buscar la posición de la primera aparición de "Escritor Marcos Arteta"
            if (strpos($newString, 'Writer') !== false) {
                $pos = strpos($newString, 'Writer');
                $fin = $pos + 60;
                $textAfter = substr($newString, $pos, $fin);
            }
            if (strpos($newString, 'Escritor') !== false) {
                $pos = strpos($newString, 'Escritor');
                $fin = $pos + 60;
                $textAfter = substr($newString, $pos, $fin);
            }
            if(strpos($textAfter, $fullName)===false||$ticket->solvedate!=null){
                return true;
            }else{
                return false;
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
}
?>