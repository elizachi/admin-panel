<?php

declare(strict_types=1);

namespace App\src\Shared\Infrastructure\Database\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240329231823 extends AbstractMigration {
    public function getDescription(): string {
        return 'Second migration: creating table with books';
    }

    public function up(Schema $schema): void {
        $this->addSql('CREATE TABLE books_book (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, publication_year INT NOT NULL, isbn INT NOT NULL, page_count INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void {
        $this->addSql('DROP TABLE books_book');
    }
}
