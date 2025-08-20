<?php

namespace App\Application\User\DTO;

use App\Domain\ValueObjects\Cpf;
use App\Domain\ValueObjects\Email;
use Illuminate\Support\Facades\Hash;

class UserCreateDTO
{
    public string $name;
    public Email $email;
    public Cpf $cpf;
    public string $password;

    public function __construct(string $name, string $email, string $cpf, int|string $password)
    {
        $this->name = $name;
        $this->email = new Email($email);
        $this->cpf = new Cpf($cpf);
        $this->password = Hash::make($password);
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'cpf' => $this->cpf,
            'password' => $this->password
        ];
    }
}
