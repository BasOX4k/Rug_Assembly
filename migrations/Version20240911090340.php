<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240911090340 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE accessoires ADD produits_id INT NOT NULL');
        $this->addSql('ALTER TABLE accessoires ADD CONSTRAINT FK_B661BA4FCD11A2CF FOREIGN KEY (produits_id) REFERENCES produits (id)');
        $this->addSql('CREATE INDEX IDX_B661BA4FCD11A2CF ON accessoires (produits_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE accessoires DROP FOREIGN KEY FK_B661BA4FCD11A2CF');
        $this->addSql('DROP INDEX IDX_B661BA4FCD11A2CF ON accessoires');
        $this->addSql('ALTER TABLE accessoires DROP produits_id');
    }
}
