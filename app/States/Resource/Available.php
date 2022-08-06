<?php

namespace App\States\Resource;

class Available extends ResourceState
{
    public static string $name = 'Available';

    public function color(): string
    {
        return 'green';
    }
}
