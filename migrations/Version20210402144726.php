<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210402144726 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE etudiant DROP FOREIGN KEY FK_717E22E35DAC5993');
        $this->addSql('DROP INDEX IDX_717E22E35DAC5993 ON etudiant');
        $this->addSql('ALTER TABLE etudiant DROP inscription_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE etudiant ADD inscription_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE etudiant ADD CONSTRAINT FK_717E22E35DAC5993 FOREIGN KEY (inscription_id) REFERENCES semestre (id)');
        $this->addSql('CREATE INDEX IDX_717E22E35DAC5993 ON etudiant (inscription_id)');
    }
}
