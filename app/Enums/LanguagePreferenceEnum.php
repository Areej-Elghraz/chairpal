<?php

namespace App\Enums;

enum LanguagePreferenceEnum: string
{
    case EN = 'en';
    case AR = 'ar';
    case FR = 'fr';
    case GE = 'ge';
    case HI = 'hi';
    case KO = 'ko';
    case VI = 'vi';

    public static function values()
    {
        return array_column(self::cases(), 'value');
    }
}
