<?php

declare(strict_types=1);

namespace App\src\Shared\Infrastructure\Database\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240330000330 extends AbstractMigration {
    public function getDescription(): string {
        return 'Third migration: creating table with authors';
    }

    public function up(Schema $schema): void {
        $this->addSql('CREATE TABLE IF NOT EXISTS authors_author (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, surname VARCHAR(255) NOT NULL, patronymic VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void {
        $this->addSql('DROP TABLE authors_author');
    }
}
