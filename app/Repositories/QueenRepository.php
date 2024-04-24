<?php

namespace App\Repositories;

use App\Models\Bee;

class QueenRepository implements HiveRepositoryInterface
{
   

    public function hit(Bee $bee)
    {
        $bee->health -= 8;
        if ($bee->health <= 0) {
            $bee->health = 0;
            $bee->save();
            return ['bee' => $bee, 'gameOver' => true];
        }
        $bee->save();
        return ['bee' => $bee, 'gameOver' => false];
    }

    public function fill()
    {
        Bee::query()
            ->where('type', 'Queen')
            ->update(['health' => 100]);
    }

}
