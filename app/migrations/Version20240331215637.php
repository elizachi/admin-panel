<?php

declare(strict_types=1);

namespace App\migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240331215637 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Second migration: ISBN field fix';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE books_book CHANGE isbn isbn VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE books_book CHANGE isbn isbn INT NOT NULL');
    }
}
