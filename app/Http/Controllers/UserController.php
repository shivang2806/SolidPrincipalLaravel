<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Request;

class UserController extends Controller
{   
    
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(Request $request)
    {
        $filters = $request->only(['name', 'email', 'status']); // Get only relevant filters
        $users = $this->userService->getUsersWithFilters($filters);

        return view('users.filterList', compact('users'));

    }

    public function show($id)
    {
        $user = $this->userService->getUserById($id);
        return view('users.show', compact('user'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        $user = $this->userService->createUser($request->all());
        return redirect()->route('users.index');
    }

    public function edit($id)
    {
        $user = $this->userService->getUserById($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        // Find the product by ID
        $user = $this->userService->getUserById($id);

        // Check if the product exists
        if (!$user) {
            return redirect()->back()->with('error', 'User Not Found');
        }

        $user = $this->userService->getUserById($id);
        $this->userService->updateUser($user, $request->all());

        return redirect()->route('users.index');
    }

    public function destroy($id)
    {
        // Find the product by ID
        $user = $this->userService->getUserById($id);

        // Check if the product exists
        if (!$user) {
            return redirect()->back()->with('error', 'User Not Found');
        }
        
        $user = $this->userService->getUserById($id);
        $this->userService->deleteUser($user);
        return redirect()->route('users.index');
    }

    public function export(Request $request)
    {
        $filters = $request->only(['name', 'email', 'status']); // Get only relevant filters

        // Get the filename of the exported CSV
        $filename = $this->userService->exportToCsv($filters);

        // Prepare the response for download
        $filePath = storage_path('app/' . $filename);
        $headers = ['Content-Type' => 'text/csv'];

        return response()->download($filePath, $filename, $headers);
    }


}