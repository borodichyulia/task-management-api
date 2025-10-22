<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;

class InvalidVerificationLinkException extends Exception
{
    protected $code = Response::HTTP_BAD_REQUEST;
    protected $message = 'Invalid verification link';
}
