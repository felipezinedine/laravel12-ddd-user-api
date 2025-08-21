<?php

namespace App\Exceptions;

use Exception;

class UserNotFoundException extends Exception
{
    protected $message = 'Usuário não existe na nossa base de dados!';
    protected $code = 404;
}
