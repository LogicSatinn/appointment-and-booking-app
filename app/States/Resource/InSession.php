<?php

namespace App\States\Resource;

class InSession extends ResourceState
{
    public static string $name = 'In Session';


    public function color(): string
    {
        return 'red';
    }
}
