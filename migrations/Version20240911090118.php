<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240911090118 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tapis ADD produits_id INT NOT NULL');
        $this->addSql('ALTER TABLE tapis ADD CONSTRAINT FK_6028B94CCD11A2CF FOREIGN KEY (produits_id) REFERENCES produits (id)');
        $this->addSql('CREATE INDEX IDX_6028B94CCD11A2CF ON tapis (produits_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tapis DROP FOREIGN KEY FK_6028B94CCD11A2CF');
        $this->addSql('DROP INDEX IDX_6028B94CCD11A2CF ON tapis');
        $this->addSql('ALTER TABLE tapis DROP produits_id');
    }
}
