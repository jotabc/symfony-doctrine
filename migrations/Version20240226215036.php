<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240226215036 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create `card` table and its relationships with `users`';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE card (id CHAR(36) NOT NULL, value VARCHAR(24) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_card (user_id CHAR(36) NOT NULL, card_id CHAR(36) NOT NULL, INDEX IDX_user_card_user_id (user_id), INDEX IDX_user_card_card_id (card_id), PRIMARY KEY(user_id, card_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_card ADD CONSTRAINT FK_user_card_user_id FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE user_card ADD CONSTRAINT FK_user_card_card_id FOREIGN KEY (card_id) REFERENCES card (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_card DROP FOREIGN KEY FK_user_card_user_id');
        $this->addSql('ALTER TABLE user_card DROP FOREIGN KEY FK_user_card_card_id');
        $this->addSql('DROP TABLE card');
        $this->addSql('DROP TABLE user_card');
    }
}
