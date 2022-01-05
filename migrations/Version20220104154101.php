<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220104154101 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE company ADD slug VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE school ADD slug VARCHAR(255) DEFAULT NULL, CHANGE logo logo VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE student ADD slug VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE company DROP slug');
        $this->addSql('ALTER TABLE school DROP slug, CHANGE logo logo VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE student DROP slug');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
    }
}
