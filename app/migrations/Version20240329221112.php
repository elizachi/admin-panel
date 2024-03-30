<?php

declare(strict_types=1);

namespace migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240329221112 extends AbstractMigration {
    public function getDescription(): string {
        return 'First migration: creating table with admin user';
    }

    public function up(Schema $schema): void {
        $this->addSql('CREATE TABLE IF NOT EXISTS users_user (ulid VARCHAR(26) NOT NULL, login VARCHAR(5) NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(ulid)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('REPLACE INTO users_user (ulid, login, password) 
        VALUES ("01FWVCJVP28A8HVEG2ETPTXE1", "admin", "5f4dcc3b5aa765d61d8327deb882cf99")');
    }

    public function down(Schema $schema): void {
        $this->addSql('DROP TABLE users_user');
    }
}