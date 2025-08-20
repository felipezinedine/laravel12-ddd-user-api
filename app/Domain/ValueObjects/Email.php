<?php

namespace App\Domain\ValueObjects;

class Email
{
    private string $email;

    public function __construct(string $incomingEmail)
    {
        if (!filter_var($incomingEmail, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException("E-mail inválido: {$incomingEmail}");
        }

        $this->email = strtolower($incomingEmail);
    }


    public function __toString(): string
    {
        return $this->email;
    }
}
