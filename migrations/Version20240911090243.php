<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240911090243 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tondeuses ADD produits_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tondeuses ADD CONSTRAINT FK_80638F6ACD11A2CF FOREIGN KEY (produits_id) REFERENCES produits (id)');
        $this->addSql('CREATE INDEX IDX_80638F6ACD11A2CF ON tondeuses (produits_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tondeuses DROP FOREIGN KEY FK_80638F6ACD11A2CF');
        $this->addSql('DROP INDEX IDX_80638F6ACD11A2CF ON tondeuses');
        $this->addSql('ALTER TABLE tondeuses DROP produits_id');
    }
}
