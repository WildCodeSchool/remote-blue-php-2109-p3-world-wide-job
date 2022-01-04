<?php

namespace App\Services;

class Slugify
{
    public function generate(string $input): string
    {
        return str_replace(' ', '-', $input);
    }
}
