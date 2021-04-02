<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210402100118 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE demande (id INT AUTO_INCREMENT NOT NULL, type_id INT NOT NULL, date_validation DATE NOT NULL, INDEX IDX_2694D7A5C54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etudiant (id INT AUTO_INCREMENT NOT NULL, filiere_id INT NOT NULL, inscription_id INT DEFAULT NULL, demande_id INT DEFAULT NULL, code_apogee VARCHAR(50) NOT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(50) NOT NULL, cne VARCHAR(50) NOT NULL, cin VARCHAR(50) NOT NULL, date_naissance DATE NOT NULL, ville_naissance VARCHAR(50) NOT NULL, pays_naissance VARCHAR(50) NOT NULL, sexe VARCHAR(50) NOT NULL, adresse VARCHAR(255) NOT NULL, annee_premiere_inscription VARCHAR(50) NOT NULL, annee_premiere_inscription_sup VARCHAR(50) NOT NULL, annee_premiere_inscription_uni_maro VARCHAR(50) NOT NULL, code_bac VARCHAR(50) NOT NULL, serie_bac VARCHAR(50) NOT NULL, INDEX IDX_717E22E3180AA129 (filiere_id), INDEX IDX_717E22E35DAC5993 (inscription_id), INDEX IDX_717E22E380E95E18 (demande_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE filiere (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, demande_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, INDEX IDX_B6BD307F80E95E18 (demande_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE module (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE semestre (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_demande (id INT AUTO_INCREMENT NOT NULL, libele VARCHAR(50) NOT NULL, nombre_max INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE demande ADD CONSTRAINT FK_2694D7A5C54C8C93 FOREIGN KEY (type_id) REFERENCES type_demande (id)');
        $this->addSql('ALTER TABLE etudiant ADD CONSTRAINT FK_717E22E3180AA129 FOREIGN KEY (filiere_id) REFERENCES filiere (id)');
        $this->addSql('ALTER TABLE etudiant ADD CONSTRAINT FK_717E22E35DAC5993 FOREIGN KEY (inscription_id) REFERENCES semestre (id)');
        $this->addSql('ALTER TABLE etudiant ADD CONSTRAINT FK_717E22E380E95E18 FOREIGN KEY (demande_id) REFERENCES demande (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F80E95E18 FOREIGN KEY (demande_id) REFERENCES demande (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE etudiant DROP FOREIGN KEY FK_717E22E380E95E18');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F80E95E18');
        $this->addSql('ALTER TABLE etudiant DROP FOREIGN KEY FK_717E22E3180AA129');
        $this->addSql('ALTER TABLE etudiant DROP FOREIGN KEY FK_717E22E35DAC5993');
        $this->addSql('ALTER TABLE demande DROP FOREIGN KEY FK_2694D7A5C54C8C93');
        $this->addSql('DROP TABLE demande');
        $this->addSql('DROP TABLE etudiant');
        $this->addSql('DROP TABLE filiere');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE module');
        $this->addSql('DROP TABLE semestre');
        $this->addSql('DROP TABLE type_demande');
        $this->addSql('DROP TABLE `user`');
    }
}
