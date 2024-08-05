<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    public function index()
    {
        $users = $this->userService->getAllUsers();
        return $users;
    }

    public function getLatest()
    {
        $user = $this->userService->getLatestUser();
        if ($user) {
            return $user;
        } else {
            // If no records are found, return a response indicating that the record is not found
            return response()->json(['message' => 'User not found'], 404);
        }
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $user = $this->userService->storeUser($data);
        return response()->json(['message' => 'User stored successfully', 'user' => $user], 201);
    }

    public function show(int $id)
    {
        $user = $this->userService->getUserById($id);
        return $user;
    }

    public function update(Request $request, int $id)
    {
        $data = $request->all();
        $user = $this->userService->updateUser($data,$id);

        // Return the updated Users record
        return response()->json(['message' => 'User updated successfully', 'user' => $user], 201);
    }

    public function destroy(int $id)
    {
        $this->userService->deleteUser($id);

        // Return a JSON response with a 204 status code
        return new JsonResponse(null, 204);
    }
}
