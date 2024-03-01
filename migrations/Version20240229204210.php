<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240229204210 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add `user.score`.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE users ADD score INT NOT NULL DEFAULT 0');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE users DROP score');
    }
}
