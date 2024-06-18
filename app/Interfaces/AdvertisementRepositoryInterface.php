<?php

namespace App\Interfaces;

interface AdvertisementRepositoryInterface
{
    public function index(array $data);
    public function getById($id);
    public function store(array $data);
}
