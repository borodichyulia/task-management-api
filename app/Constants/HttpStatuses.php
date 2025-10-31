<?php

namespace App\Constants;

class HttpStatuses
{
    public const HTTP_CREATED = 201;
    public const HTTP_NO_CONTENT = 204;
    public const HTTP_UNAUTHORIZED = 401;

    public static function getStatusMessage($code): string
    {
        return match($code) {
            self::HTTP_CREATED => 'Created',
            self::HTTP_NO_CONTENT => 'No Content',
            self::HTTP_UNAUTHORIZED => 'Unauthorized',
            default => 'Unknown Status',
        };
    }
}
