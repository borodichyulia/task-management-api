<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;

class EmailAlreadyVerifiedException extends Exception
{
    protected $code = Response::HTTP_OK;
    protected $message = 'Email already verified';
}
