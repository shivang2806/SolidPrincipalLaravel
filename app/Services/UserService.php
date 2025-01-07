<?php

namespace App\Services;

use App\Interfaces\UserInterface;
use App\Models\User;

class UserService
{
    protected $userRepository;

    public function __construct(UserInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function createUser(array $data): User
    {
        // You can add validation or extra logic here
        return $this->userRepository->create($data);
    }

    public function updateUser(User $user, array $data): bool
    {
        // You can add validation or extra logic here
        return $this->userRepository->update($user, $data);
    }

    public function deleteUser(User $user): bool
    {
        return $this->userRepository->delete($user);
    }

    public function getUserById(int $id): ?User
    {
        return $this->userRepository->findById($id);
    }

    public function getAllUsers(): array
    {
        return $this->userRepository->all();
    }

    public function getUsersWithFilters(array $filters)
    {
        return $this->userRepository->filterUsers($filters);
    }
    
    public function exportToCsv(array $filters = [])
    {
        // Get filtered users
        $users = $this->userRepository->filterUsers($filters);

        // Create a CSV writer instance
        $csv = Writer::createFromFileObject(new SplTempFileObject());

        // Add CSV headers
        $csv->insertOne(['ID', 'Name', 'Email', 'Status']);

        // Add user data to CSV
        foreach ($users as $user) {
            $csv->insertOne([$user->id, $user->name, $user->email, $user->status]);
        }

        // Generate a filename
        $filename = 'users_' . now()->format('Y_m_d_H_i_s') . '.csv';

        // Store the CSV file locally or on any configured disk
        Storage::disk('local')->put($filename, $csv->toString());

        return $filename;
    }
}
