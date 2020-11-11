<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201111194510 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commercant ADD id_categorie_id INT NOT NULL');
        $this->addSql('ALTER TABLE commercant ADD CONSTRAINT FK_ECB4268F9F34925F FOREIGN KEY (id_categorie_id) REFERENCES categories (id)');
        $this->addSql('CREATE INDEX IDX_ECB4268F9F34925F ON commercant (id_categorie_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commercant DROP FOREIGN KEY FK_ECB4268F9F34925F');
        $this->addSql('DROP INDEX IDX_ECB4268F9F34925F ON commercant');
        $this->addSql('ALTER TABLE commercant DROP id_categorie_id');
    }
}
