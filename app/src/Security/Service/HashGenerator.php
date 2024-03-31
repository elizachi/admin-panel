<?php

declare(strict_types=1);

namespace App\Security\Service;

class HashGenerator
{
    public function __construct() {
    }

    public function hash(string $password): string {
        return md5($password);
    }
}