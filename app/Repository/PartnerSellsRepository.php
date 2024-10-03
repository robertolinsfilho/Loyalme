<?php

namespace App\Repositories;

use App\Models\PartnerSells;
use App\Interfaces\PartnerSellsRepositoryInterface;

class PartnerSellsRepository implements PartnerSellsRepositoryInterface
{
    public function store(array $data){
        return PartnerSells::create($data);
     }
}
