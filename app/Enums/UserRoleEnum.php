<?php

namespace App\Enums;

enum UserRoleEnum: string
{
    case USER = 'user';
    case ORGANIZATION = 'organization';
    case ADMIN = 'admin';

    public static function values()
    {
        return array_column(self::cases(), 'value');
    }
}
