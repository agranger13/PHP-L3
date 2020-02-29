<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200229131253 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE ligne_prescriptive (id INT AUTO_INCREMENT NOT NULL, ordonnance_id INT NOT NULL, medicament_id INT NOT NULL, posologie VARCHAR(255) NOT NULL, INDEX IDX_ABB388862BF23B8F (ordonnance_id), INDEX IDX_ABB38886AB0D61F7 (medicament_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE medicament (id INT AUTO_INCREMENT NOT NULL, denomination VARCHAR(80) NOT NULL, conditionnement VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ligne_prescriptive ADD CONSTRAINT FK_ABB388862BF23B8F FOREIGN KEY (ordonnance_id) REFERENCES ordonnance (id)');
        $this->addSql('ALTER TABLE ligne_prescriptive ADD CONSTRAINT FK_ABB38886AB0D61F7 FOREIGN KEY (medicament_id) REFERENCES medicament (id)');
        $this->addSql('ALTER TABLE ordonnance ADD medecin_id INT DEFAULT NULL, CHANGE numero_ordre numero_ordre VARCHAR(15) NOT NULL');
        $this->addSql('ALTER TABLE ordonnance ADD CONSTRAINT FK_924B326C4F31A84 FOREIGN KEY (medecin_id) REFERENCES medecin (id)');
        $this->addSql('CREATE INDEX IDX_924B326C4F31A84 ON ordonnance (medecin_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ligne_prescriptive DROP FOREIGN KEY FK_ABB38886AB0D61F7');
        $this->addSql('DROP TABLE ligne_prescriptive');
        $this->addSql('DROP TABLE medicament');
        $this->addSql('ALTER TABLE ordonnance DROP FOREIGN KEY FK_924B326C4F31A84');
        $this->addSql('DROP INDEX IDX_924B326C4F31A84 ON ordonnance');
        $this->addSql('ALTER TABLE ordonnance DROP medecin_id, CHANGE numero_ordre numero_ordre INT NOT NULL');
    }
}
