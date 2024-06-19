<?php

namespace App\Repositories;

use App\Interfaces\AdvertisementRepositoryInterface;
use App\Models\Advertisement;
use http\Client\Request;

class AdvertisementRepository implements AdvertisementRepositoryInterface
{
    public function index(array $data)
    {
        $sortField = $data['sort_field'];

        if (!in_array($sortField, ['price', 'created_at'])) {
            $sortField = 'created_at';
        }

        $sortDirection = $data['sort_direction'];

        if (!in_array($sortDirection, ['asc', 'desc'])) {
            $sortDirection = 'desc';
        }

        return Advertisement::orderBy($sortField, $sortDirection)->paginate(10);
    }

    public function getById($id)
    {
        return Advertisement::findOrFail($id);
    }

    public function store(array $data)
    {
        return Advertisement::create($data);
    }
}
