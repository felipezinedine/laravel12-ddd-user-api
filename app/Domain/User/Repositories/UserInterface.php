<?php

namespace App\Domain\User\Repositories;

use App\Domain\User\Entities\User as UserEntity;

interface UserInterface
{
    public function index (): array;
    public function getById (int $userId): ?UserEntity;
    public function store (array $data);
    public function update (array $data, int $userId);
    public function delete (int $userId);
}
