<?php

namespace app\Domain\User\Mappers;

use App\Domain\User\Models\User as UserModel;
use App\Domain\User\Entities\User as UserEntity;

class UserMapper
{
    public static function toEntity (UserModel $model): UserEntity
    {
        return new UserEntity (
            $model->id,
            $model->name,
            $model->cpf,
            $model->email,
        );
    }

    public static function toModel (UserEntity $entity): UserModel
    {
        $model = new UserModel();
        $model->id = $entity->id;
        $model->name = $entity->name;
        $model->cpf = $entity->cpf;
        $model->email = $entity->email;

        return $model;
    }
}
