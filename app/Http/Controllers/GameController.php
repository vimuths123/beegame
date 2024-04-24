<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bee;
use App\Repositories\QueenRepository;
use App\Repositories\WorkerRepository;
use App\Repositories\DroneRepository;

use function PHPSTORM_META\type;

class GameController extends Controller
{
    protected $queenRepository;
    protected $workerRepository;
    protected $droneRepository;

    public function __construct(QueenRepository $queenRepository, WorkerRepository $workerRepository, DroneRepository $droneRepository)
    {
        $this->queenRepository = $queenRepository;
        $this->workerRepository = $workerRepository;
        $this->droneRepository = $droneRepository;
    }
    /**
     * Hit a bee.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function hitBee(Request $request)
    {
        // Generate a random ID between 1 and 14
        $randomBeeId = rand(1, 14);

        // Fetch the Bee model instance by the random ID
        $bee = Bee::find($randomBeeId);

        // Check if the bee exists
        if (!$bee) {
            return response()->json([
                'status' => 'error',
                'message' => 'No bee found with the specified ID.'
            ], 404);
        }

        // Determine the repository based on the bee's type
        $repository = $this->getRepository($bee->type);
        if (!$repository) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid bee type.'
            ], 400);
        }

        // Call the hit method on the determined repository
        $result = $repository->hit($bee);

        if ($result['gameOver']) {
            $this->queenRepository->fill();
            $this->workerRepository->fill();
            $this->droneRepository->fill();

            return response()->json([
                'status' => 'Game Over',
                'message' => 'The Queen bee has been hit and her health is now 0. Game over.',
                'bee' => $result['bee']
            ]);
        }

        // Return the result
        return response()->json([
            'status' => 'success',
            'message' => 'You hit a ' . $bee->type . ' bee!',
            'bee' => $result
        ]);
    }
    
    protected function getRepository($type)
    {
        switch ($type) {
            case 'Queen':
                return $this->queenRepository;
            case 'Worker':
                return $this->workerRepository;
            case 'Drone':
                return $this->droneRepository;
            default:
                return null;
        }
    }

    public function getAllBees()
    {
        $bees = Bee::all();

        return response()->json($bees);
    }

}
