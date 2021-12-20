<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211220170448 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE company ADD updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE school ADD updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE student ADD updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE zip zip VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE company DROP updated_at');
        $this->addSql('ALTER TABLE school DROP updated_at');
        $this->addSql('ALTER TABLE student DROP updated_at');
        $this->addSql('ALTER TABLE user CHANGE zip zip INT DEFAULT NULL');
    }
}
