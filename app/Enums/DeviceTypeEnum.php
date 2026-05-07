<?php

namespace App\Enums;

enum DeviceTypeEnum: string
{
    case IOS = 'ios';
    case ANDROID = 'android';
    // case WEB = 'web';

    public static function values()
    {
        return array_column(self::cases(), 'value');
    }
}
