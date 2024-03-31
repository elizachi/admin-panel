<?php

declare(strict_types=1);

namespace App\migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240330091209 extends AbstractMigration 
{
    public function getDescription(): string
    {
        return 'First migration: add users_user, books_book, authors_author tables and admin user';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE IF NOT EXISTS authors_author (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, surname VARCHAR(255) NOT NULL, patronymic VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE IF NOT EXISTS books_book (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, publication_year INT NOT NULL, isbn INT NOT NULL, page_count INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE IF NOT EXISTS users_user (id INT AUTO_INCREMENT NOT NULL, login VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');

        $this->addSql('REPLACE INTO users_user (login, password) VALUES ("admin", "5f4dcc3b5aa765d61d8327deb882cf99")');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE authors_author');
        $this->addSql('DROP TABLE books_book');
        $this->addSql('DROP TABLE users_user');
    }
}
