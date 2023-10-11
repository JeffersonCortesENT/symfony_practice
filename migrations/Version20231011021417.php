<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231011021417 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_level (id INT AUTO_INCREMENT NOT NULL, level_code VARCHAR(100) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user ADD user_level_id INT NOT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649BF3CAFA7 FOREIGN KEY (user_level_id) REFERENCES user_level (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649BF3CAFA7 ON user (user_level_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649BF3CAFA7');
        $this->addSql('DROP TABLE user_level');
        $this->addSql('DROP INDEX IDX_8D93D649BF3CAFA7 ON user');
        $this->addSql('ALTER TABLE user DROP user_level_id');
    }
}
