<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220108200100 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4FBF094F989D9B62 ON company (slug)');
        $this->addSql('ALTER TABLE school CHANGE user_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE student ADD username VARCHAR(255) DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B723AF33F85E0677 ON student (username)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_4FBF094F989D9B62 ON company');
        $this->addSql('ALTER TABLE school CHANGE user_id user_id INT NOT NULL');
        $this->addSql('DROP INDEX UNIQ_B723AF33F85E0677 ON student');
        $this->addSql('ALTER TABLE student DROP username');
    }
}
