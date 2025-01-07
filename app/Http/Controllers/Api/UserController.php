<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of users with optional filters.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filters = $request->only(['name', 'email', 'status']); // Get only relevant filters
        $users = $this->userService->getUsersWithFilters($filters);

        return response()->json($users, Response::HTTP_OK);
    }

    /**
     * Store a newly created user in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        $user = $this->userService->createUser($request->all());
        return response()->json($user, Response::HTTP_CREATED);
    }

    /**
     * Display the specified user.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->userService->getUserById($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($user, Response::HTTP_OK);
    }

    /**
     * Update the specified user in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        $user = $this->userService->getUserById($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], Response::HTTP_NOT_FOUND);
        }

        $this->userService->updateUser($user, $request->all());
        return response()->json($user, Response::HTTP_OK);
    }

    /**
     * Remove the specified user from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = $this->userService->getUserById($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], Response::HTTP_NOT_FOUND);
        }

        $this->userService->deleteUser($user);
        return response()->json(['message' => 'User deleted successfully'], Response::HTTP_NO_CONTENT);
    }

    public function export(Request $request)
    {
        $filters = $request->only(['name', 'email', 'status']); // Get only relevant filters

        // Get the filename of the exported CSV
        $filename = $this->userService->exportToCsv($filters);

        // Prepare the response for download
        $link = storage_path('app/' . $filename);

        return response()->json($link, Response::HTTP_OK);

    }
    
}
