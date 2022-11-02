<?php

namespace App\Support\Helpers;

use Illuminate\Support\Str;

final class PhoneNumberMnoGetter
{
    public function __construct(
        private readonly string $phone_number
    )
    {
    }

    public function getMno(): string
    {
        return match (true) {
            Str::startsWith(haystack: $this->phone_number, needles: ['25574', '25575', '25576']) => 'Vodacom',
            Str::startsWith(haystack: $this->phone_number, needles: ['25578', '25568', '25569']) => 'Airtel',
            Str::startsWith(haystack: $this->phone_number, needles: ['25565', '25567', '25571']) => 'Tigo',
            Str::startsWith(haystack: $this->phone_number, needles: ['25562']) => 'Halotel',
            Str::startsWith(haystack: $this->phone_number, needles: ['25573']) => 'TTCL',
        };
    }
}
