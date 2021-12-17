<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211217085648 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE application (id INT AUTO_INCREMENT NOT NULL, student_id INT NOT NULL, offer_id INT NOT NULL, status INT DEFAULT NULL, INDEX IDX_A45BDDC1CB944F1A (student_id), INDEX IDX_A45BDDC153C674EE (offer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE company (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, logo VARCHAR(255) DEFAULT NULL, company_name VARCHAR(255) DEFAULT NULL, company_format VARCHAR(255) DEFAULT NULL, siret VARCHAR(255) DEFAULT NULL, siren VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, UNIQUE INDEX UNIQ_4FBF094FA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE curriculum (id INT AUTO_INCREMENT NOT NULL, student_id INT NOT NULL, picture VARCHAR(255) DEFAULT NULL, skills VARCHAR(255) DEFAULT NULL, language VARCHAR(255) DEFAULT NULL, driving_licence TINYINT(1) DEFAULT NULL, UNIQUE INDEX UNIQ_7BE2A7C3CB944F1A (student_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE degree (id INT AUTO_INCREMENT NOT NULL, school_id INT NOT NULL, degree VARCHAR(255) DEFAULT NULL, INDEX IDX_A7A36D63C32A47EE (school_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE experience (id INT AUTO_INCREMENT NOT NULL, curriculum_id INT NOT NULL, job_position VARCHAR(255) DEFAULT NULL, company VARCHAR(255) DEFAULT NULL, localisation VARCHAR(255) DEFAULT NULL, contract_type INT DEFAULT NULL, date_in DATE DEFAULT NULL, date_out DATE DEFAULT NULL, description LONGTEXT DEFAULT NULL, INDEX IDX_590C1035AEA4428 (curriculum_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE offer (id INT AUTO_INCREMENT NOT NULL, company_id INT NOT NULL, name VARCHAR(255) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, contract_type INT DEFAULT NULL, duration INT DEFAULT NULL, short_description VARCHAR(255) DEFAULT NULL, date_of_publication DATETIME DEFAULT NULL, long_description LONGTEXT DEFAULT NULL, field_of_activity INT DEFAULT NULL, job_position VARCHAR(255) DEFAULT NULL, date_in DATE DEFAULT NULL, wage INT DEFAULT NULL, tutor VARCHAR(255) DEFAULT NULL, driving_licence TINYINT(1) DEFAULT NULL, INDEX IDX_29D6873E979B1AD6 (company_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE school (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, logo VARCHAR(255) DEFAULT NULL, school_name VARCHAR(255) DEFAULT NULL, school_code VARCHAR(255) DEFAULT NULL, school_desc LONGTEXT DEFAULT NULL, type INT DEFAULT NULL, UNIQUE INDEX UNIQ_F99EDABBA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE student (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, school_id INT NOT NULL, picture VARCHAR(255) DEFAULT NULL, ine VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_B723AF33A76ED395 (user_id), INDEX IDX_B723AF33C32A47EE (school_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE student_degree (student_id INT NOT NULL, degree_id INT NOT NULL, INDEX IDX_2995B5E3CB944F1A (student_id), INDEX IDX_2995B5E3B35C5756 (degree_id), PRIMARY KEY(student_id, degree_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE training (id INT AUTO_INCREMENT NOT NULL, curriculum_id INT NOT NULL, field_of_study VARCHAR(255) DEFAULT NULL, school VARCHAR(255) DEFAULT NULL, degree VARCHAR(255) DEFAULT NULL, graduate TINYINT(1) DEFAULT NULL, date_in DATE DEFAULT NULL, date_out DATE DEFAULT NULL, description LONGTEXT DEFAULT NULL, INDEX IDX_D5128A8F5AEA4428 (curriculum_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, mail VARCHAR(255) DEFAULT NULL, password VARCHAR(255) DEFAULT NULL, civility VARCHAR(255) DEFAULT NULL, firstname VARCHAR(255) DEFAULT NULL, lastname VARCHAR(255) DEFAULT NULL, birthdate DATE DEFAULT NULL, phone VARCHAR(255) DEFAULT NULL, adress1 VARCHAR(255) DEFAULT NULL, adress2 VARCHAR(255) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, zip INT DEFAULT NULL, country VARCHAR(255) DEFAULT NULL, role INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE application ADD CONSTRAINT FK_A45BDDC1CB944F1A FOREIGN KEY (student_id) REFERENCES student (id)');
        $this->addSql('ALTER TABLE application ADD CONSTRAINT FK_A45BDDC153C674EE FOREIGN KEY (offer_id) REFERENCES offer (id)');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT FK_4FBF094FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE curriculum ADD CONSTRAINT FK_7BE2A7C3CB944F1A FOREIGN KEY (student_id) REFERENCES student (id)');
        $this->addSql('ALTER TABLE degree ADD CONSTRAINT FK_A7A36D63C32A47EE FOREIGN KEY (school_id) REFERENCES school (id)');
        $this->addSql('ALTER TABLE experience ADD CONSTRAINT FK_590C1035AEA4428 FOREIGN KEY (curriculum_id) REFERENCES curriculum (id)');
        $this->addSql('ALTER TABLE offer ADD CONSTRAINT FK_29D6873E979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE school ADD CONSTRAINT FK_F99EDABBA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF33A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF33C32A47EE FOREIGN KEY (school_id) REFERENCES school (id)');
        $this->addSql('ALTER TABLE student_degree ADD CONSTRAINT FK_2995B5E3CB944F1A FOREIGN KEY (student_id) REFERENCES student (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE student_degree ADD CONSTRAINT FK_2995B5E3B35C5756 FOREIGN KEY (degree_id) REFERENCES degree (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE training ADD CONSTRAINT FK_D5128A8F5AEA4428 FOREIGN KEY (curriculum_id) REFERENCES curriculum (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE offer DROP FOREIGN KEY FK_29D6873E979B1AD6');
        $this->addSql('ALTER TABLE experience DROP FOREIGN KEY FK_590C1035AEA4428');
        $this->addSql('ALTER TABLE training DROP FOREIGN KEY FK_D5128A8F5AEA4428');
        $this->addSql('ALTER TABLE student_degree DROP FOREIGN KEY FK_2995B5E3B35C5756');
        $this->addSql('ALTER TABLE application DROP FOREIGN KEY FK_A45BDDC153C674EE');
        $this->addSql('ALTER TABLE degree DROP FOREIGN KEY FK_A7A36D63C32A47EE');
        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF33C32A47EE');
        $this->addSql('ALTER TABLE application DROP FOREIGN KEY FK_A45BDDC1CB944F1A');
        $this->addSql('ALTER TABLE curriculum DROP FOREIGN KEY FK_7BE2A7C3CB944F1A');
        $this->addSql('ALTER TABLE student_degree DROP FOREIGN KEY FK_2995B5E3CB944F1A');
        $this->addSql('ALTER TABLE company DROP FOREIGN KEY FK_4FBF094FA76ED395');
        $this->addSql('ALTER TABLE school DROP FOREIGN KEY FK_F99EDABBA76ED395');
        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF33A76ED395');
        $this->addSql('DROP TABLE application');
        $this->addSql('DROP TABLE company');
        $this->addSql('DROP TABLE curriculum');
        $this->addSql('DROP TABLE degree');
        $this->addSql('DROP TABLE experience');
        $this->addSql('DROP TABLE offer');
        $this->addSql('DROP TABLE school');
        $this->addSql('DROP TABLE student');
        $this->addSql('DROP TABLE student_degree');
        $this->addSql('DROP TABLE training');
        $this->addSql('DROP TABLE user');
    }
}
