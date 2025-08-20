<?php


namespace App\Application\User\DTO;

use App\Domain\ValueObjects\Email;
use App\Domain\ValueObjects\Cpf;


class UserUpdateDTO
{
    public ?string $name;
    public ?Email $email;
    public ?Cpf $cpf;

    public function __construct(?string $name, ?string $email, ?string $cpf)
    {
        $this->name = $name;
        $this->email = $email ? new Email($email) : null;
        $this->cpf = $cpf ? new Cpf($cpf) : null;
    }

    public function toArray(): array
    {
        return array_filter([
            'name' => $this->name,
            'email' => $this->email,
            'cpf' => $this->cpf
        ], fn($value) => !is_null($value));
    }
}
