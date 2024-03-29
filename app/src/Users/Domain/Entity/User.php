<?php

declare(strict_types=1);

namespace App\Users\Domain\Entity;
use Symfony\Component\Uid\Ulid;

class User {
    private string $ulid;
    private string $login;
    private ?string $password = null;

    /**
     * @var array<string>
     */
    private array $roles = [];

    public function __construct(string $login, string $password)
    {
        $this->ulid = Ulid::generate();
        $this->email = $login;

        $this->password = $password;
    }

    public function getId(): string
    {
        return $this->ulid;
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }
}