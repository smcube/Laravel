<?php
/**
 * Description of UsersService.php
 *
 *
 */

namespace App\Services\Users;


use App\Models\User;

use App\Services\Users\Repositories\UserRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class UsersService
{

    /** @var UserRepositoryInterface */
    private $userRepository;

    private $createUserHandler;

    public function __construct(

        UserRepositoryInterface $userRepository
    )
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param int $id
     * @return User|null
     */
    public function findUser(int $id)
    {
        // return $this->userRepository->find($id);
    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function searchUsers(): LengthAwarePaginator
    {
        return $this->userRepository->search();

    }

    /**
     * @param array $data
     * @return User
     */
    public function storeUser(array $data): User
    {
        $user = $this->userRepository->create($data);
        return $user;
    }

    /**
     * @param User $user
     * @param array $data
     * @return User
     */
    public function updateUser(User $user, array $data)
    {
        return $this->userRepository->updateFromArray($user, $data);
    }

    public function deleteUser(int $id)
    {
        return $this->userRepository->delete($id);
    }

    public function searchUserRoles(User $user)
    {
        return $this->userRepository->roles($user);

    }


}