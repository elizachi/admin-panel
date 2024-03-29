<?php

declare(strict_types=1);

namespace App\src\Shared\Infrastructure\Database\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240329115733 extends AbstractMigration {
    public function getDescription(): string {
        return 'First migration: creating a table with admin user';
    }

    public function up(Schema $schema): void {
        $this->addSql('CREATE TABLE users_user (ulid VARCHAR(26) NOT NULL, login VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(ulid)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void {
        $this->addSql('DROP TABLE users_user');
    }

    public function addAdmin(Schema $shema): void {
        $this->addSql('REPLACE INTO users_user (ulid, user, pass) 
        VALUES (01FWVCJVP28A8HVEG2ETPTXE1, admin, 5f4dcc3b5aa765d61d8327deb882cf99)');
    }
}
