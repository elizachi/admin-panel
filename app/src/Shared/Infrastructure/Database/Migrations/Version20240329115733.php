<?php

declare(strict_types=1);

namespace App\src\Shared\Infrastructure\Database\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240329115733 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'First migration: creating a table with admin users';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE users_user (ulid VARCHAR(26) NOT NULL, login VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(ulid)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE users_user');
    }
}
