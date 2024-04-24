<?php

namespace App\Repositories;

use App\Models\Bee;

interface HiveRepositoryInterface
{
    public function hit(Bee $bee);
}
