<?php

declare(strict_types=1);

namespace App\Services\Workout;

use App\Models\Location;
use App\Services\Workout\Interfaces\WorkoutServiceInterface;
use App\Models\Workout;
use App\Models\User;
use App\Services\Workout\Repositories\WorkoutRepository;
use Illuminate\Database\Eloquent\Collection;

class WorkoutService implements WorkoutServiceInterface {

    /**
     * @var WorkoutRepository
     */
    private $workoutRepository;

    /**
     * WorkoutService constructor.
     *
     * @param  WorkoutRepository  $workoutRepository
     */
    public function __construct(WorkoutRepository $workoutRepository)
    {
        $this->workoutRepository = $workoutRepository;
    }

    /**
     * Find and paginate a collection of records.
     *
     * @param  array  $conditions
     * @return Workout|Collection|static[]|static|null
     */
    public function search(array $conditions = [])
    {
        return $this->workoutRepository->search($conditions);
    }

    /**
     * Find a record by its primary key.
     *
     * @param  int  $id
     * @return Workout|Collection|static[]|static|null
     */
    public function findById(int $id)
    {
        return $this->workoutRepository->find($id);
    }

    /**
     * Create a record and fill it with values.
     *
     * @param  array  $data
     * @return Workout|static
     */
    public function create(array $data)
    {
        return $this->workoutRepository->create($data);
    }

    /**
     * Update a record and fill it with values.
     *
     * @param  Workout  $workout
     * @param  array  $data
     * @return Workout|static
     */
    public function update(Workout $workout, array $data)
    {
        return $this->workoutRepository->update($workout, $data);
    }

    /**
     * Delete a record from the database.
     *
     * @param  Workout  $workout
     * @return mixed
     */
    public function delete(Workout $workout)
    {
        return $this->workoutRepository->delete($workout);
    }

    /**
     * Find a record by User.
     *
     * @param  User  $user
     * @return Workout|Collection|static[]|static|null
     */
    public function getByUser(User $user)
    {
        return $this->search(['user_id' => $user->id]);
    }

    /**
     * Find a record by Location.
     *
     * @param  Location  $location
     * @return Workout|Collection|static[]|static|null
     */
    public function getByLocation(Location $location)
    {
        // TODO
    }
}
