<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211215234329 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE experience DROP FOREIGN KEY FK_590C103CFE419E2');
        $this->addSql('ALTER TABLE training DROP FOREIGN KEY FK_D5128A8FCFE419E2');
        $this->addSql('CREATE TABLE curriculum (id INT AUTO_INCREMENT NOT NULL, student_id INT NOT NULL, picture VARCHAR(255) DEFAULT NULL, skills VARCHAR(255) DEFAULT NULL, language VARCHAR(255) DEFAULT NULL, driving_licence TINYINT(1) DEFAULT NULL, UNIQUE INDEX UNIQ_7BE2A7C3CB944F1A (student_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE curriculum ADD CONSTRAINT FK_7BE2A7C3CB944F1A FOREIGN KEY (student_id) REFERENCES student (id)');
        $this->addSql('DROP TABLE cv');
        $this->addSql('DROP TABLE student_school');
        $this->addSql('ALTER TABLE application DROP INDEX UNIQ_A45BDDC153C674EE, ADD INDEX IDX_A45BDDC153C674EE (offer_id)');
        $this->addSql('ALTER TABLE application DROP INDEX UNIQ_A45BDDC1CB944F1A, ADD INDEX IDX_A45BDDC1CB944F1A (student_id)');
        $this->addSql('ALTER TABLE company ADD company_name VARCHAR(255) DEFAULT NULL, ADD company_format VARCHAR(255) DEFAULT NULL, DROP society_name, DROP society_format, CHANGE description description LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE degree CHANGE degree degre VARCHAR(255) DEFAULT NULL');
        $this->addSql('DROP INDEX IDX_590C103CFE419E2 ON experience');
        $this->addSql('ALTER TABLE experience CHANGE cv_id curriculum_id INT NOT NULL, CHANGE job_description description LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE experience ADD CONSTRAINT FK_590C1035AEA4428 FOREIGN KEY (curriculum_id) REFERENCES curriculum (id)');
        $this->addSql('CREATE INDEX IDX_590C1035AEA4428 ON experience (curriculum_id)');
        $this->addSql('ALTER TABLE offer ADD short_description VARCHAR(255) DEFAULT NULL, DROP short_desc, CHANGE company_id company_id INT NOT NULL, CHANGE long_desc long_description LONGTEXT DEFAULT NULL, CHANGE date date_in DATE DEFAULT NULL, CHANGE driving_license driving_licence TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE school ADD school_desc LONGTEXT DEFAULT NULL, DROP school_description');
        $this->addSql('ALTER TABLE student ADD school_id INT NOT NULL');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF33C32A47EE FOREIGN KEY (school_id) REFERENCES school (id)');
        $this->addSql('CREATE INDEX IDX_B723AF33C32A47EE ON student (school_id)');
        $this->addSql('DROP INDEX IDX_D5128A8FCFE419E2 ON training');
        $this->addSql('ALTER TABLE training CHANGE cv_id curriculum_id INT NOT NULL');
        $this->addSql('ALTER TABLE training ADD CONSTRAINT FK_D5128A8F5AEA4428 FOREIGN KEY (curriculum_id) REFERENCES curriculum (id)');
        $this->addSql('CREATE INDEX IDX_D5128A8F5AEA4428 ON training (curriculum_id)');
        $this->addSql('ALTER TABLE user ADD firstname VARCHAR(255) DEFAULT NULL, ADD lastname VARCHAR(255) DEFAULT NULL, DROP first_name, DROP last_name');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE experience DROP FOREIGN KEY FK_590C1035AEA4428');
        $this->addSql('ALTER TABLE training DROP FOREIGN KEY FK_D5128A8F5AEA4428');
        $this->addSql('CREATE TABLE cv (id INT AUTO_INCREMENT NOT NULL, student_id INT DEFAULT NULL, video VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, skills VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, driving_licence TINYINT(1) DEFAULT NULL, UNIQUE INDEX UNIQ_B66FFE92CB944F1A (student_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE student_school (student_id INT NOT NULL, school_id INT NOT NULL, INDEX IDX_77A8023BC32A47EE (school_id), INDEX IDX_77A8023BCB944F1A (student_id), PRIMARY KEY(student_id, school_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE cv ADD CONSTRAINT FK_B66FFE92CB944F1A FOREIGN KEY (student_id) REFERENCES student (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE student_school ADD CONSTRAINT FK_77A8023BC32A47EE FOREIGN KEY (school_id) REFERENCES school (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE student_school ADD CONSTRAINT FK_77A8023BCB944F1A FOREIGN KEY (student_id) REFERENCES student (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('DROP TABLE curriculum');
        $this->addSql('ALTER TABLE application DROP INDEX IDX_A45BDDC1CB944F1A, ADD UNIQUE INDEX UNIQ_A45BDDC1CB944F1A (student_id)');
        $this->addSql('ALTER TABLE application DROP INDEX IDX_A45BDDC153C674EE, ADD UNIQUE INDEX UNIQ_A45BDDC153C674EE (offer_id)');
        $this->addSql('ALTER TABLE company ADD society_name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD society_format VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, DROP company_name, DROP company_format, CHANGE description description VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE degree CHANGE degre degree VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('DROP INDEX IDX_590C1035AEA4428 ON experience');
        $this->addSql('ALTER TABLE experience CHANGE curriculum_id cv_id INT NOT NULL, CHANGE description job_description LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE experience ADD CONSTRAINT FK_590C103CFE419E2 FOREIGN KEY (cv_id) REFERENCES cv (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_590C103CFE419E2 ON experience (cv_id)');
        $this->addSql('ALTER TABLE offer ADD short_desc VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP short_description, CHANGE company_id company_id INT DEFAULT NULL, CHANGE long_description long_desc LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE date_in date DATE DEFAULT NULL, CHANGE driving_licence driving_license TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE school ADD school_description VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, DROP school_desc');
        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF33C32A47EE');
        $this->addSql('DROP INDEX IDX_B723AF33C32A47EE ON student');
        $this->addSql('ALTER TABLE student DROP school_id');
        $this->addSql('DROP INDEX IDX_D5128A8F5AEA4428 ON training');
        $this->addSql('ALTER TABLE training CHANGE curriculum_id cv_id INT NOT NULL');
        $this->addSql('ALTER TABLE training ADD CONSTRAINT FK_D5128A8FCFE419E2 FOREIGN KEY (cv_id) REFERENCES cv (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_D5128A8FCFE419E2 ON training (cv_id)');
        $this->addSql('ALTER TABLE user ADD first_name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD last_name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, DROP firstname, DROP lastname');
    }
}
