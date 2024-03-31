<?php

declare(strict_types=1);

namespace App\Entity;
use Symfony\Component\Uid\Ulid;

class User {
    private int $userId;
    private string $login;
    private ?string $password = null;

    public function __construct(string $login, string $password) {
        $this->login = $login;
        $this->password = $password;
    }

    public function getId(): int {
        return $this->userId;
    }

    public function getLogin(): string {
        return $this->login;
    }

    public function getPassword(): ?string {
        return $this->password;
    }
}