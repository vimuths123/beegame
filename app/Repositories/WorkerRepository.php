<?php

namespace App\Repositories;

use App\Models\Bee;

class WorkerRepository implements HiveRepositoryInterface
{
    public function hit(Bee $bee)
    {
        $bee->health -= 10;
        if ($bee->health < 0) {
            $bee->health = 0;
        }
        $bee->save();
        return $bee;
    }

    public function fill()
    {
        Bee::query()
            ->where('type', 'Worker')
            ->update(['health' => 75]);
    }
}
