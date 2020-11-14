<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201114112749 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE merchant_category (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, color VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE merchant ADD category_id INT ');
        $this->addSql('ALTER TABLE merchant ADD CONSTRAINT FK_74AB25E112469DE2 FOREIGN KEY (category_id) REFERENCES merchant_category (id)');
        $this->addSql('CREATE INDEX IDX_74AB25E112469DE2 ON merchant (category_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE merchant DROP FOREIGN KEY FK_74AB25E112469DE2');
        $this->addSql('DROP TABLE merchant_category');
        $this->addSql('DROP INDEX IDX_74AB25E112469DE2 ON merchant');
        $this->addSql('ALTER TABLE merchant DROP category_id');
    }
}
