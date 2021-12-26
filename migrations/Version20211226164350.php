<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211226164350 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE company ADD slug VARCHAR(255) NOT NULL, DROP updated_at');
        $this->addSql('ALTER TABLE school ADD slug VARCHAR(255) NOT NULL, DROP updated_at');
        $this->addSql('ALTER TABLE student ADD slug VARCHAR(255) NOT NULL, DROP updated_at');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE company ADD updated_at DATETIME DEFAULT NULL, DROP slug');
        $this->addSql('ALTER TABLE school ADD updated_at DATETIME DEFAULT NULL, DROP slug');
        $this->addSql('ALTER TABLE student ADD updated_at DATETIME DEFAULT NULL, DROP slug');
    }
}
