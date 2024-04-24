<?php

namespace App\Repositories;

use App\Models\Bee;
use App\Models\Queen;

class DroneRepository implements HiveRepositoryInterface
{
   

    public function hit(Bee $bee)
    {
        $bee->health -= 12;
        if ($bee->health < 0) {
            $bee->health = 0;
        }
        $bee->save();
        return $bee;
    }

    public function fill()
    {
        Bee::query()
            ->where('type', 'Drone')
            ->update(['health' => 50]);
    }

}
