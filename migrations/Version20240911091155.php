<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240911091155 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fils ADD produits_id INT NOT NULL');
        $this->addSql('ALTER TABLE fils ADD CONSTRAINT FK_784B8341CD11A2CF FOREIGN KEY (produits_id) REFERENCES produits (id)');
        $this->addSql('CREATE INDEX IDX_784B8341CD11A2CF ON fils (produits_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fils DROP FOREIGN KEY FK_784B8341CD11A2CF');
        $this->addSql('DROP INDEX IDX_784B8341CD11A2CF ON fils');
        $this->addSql('ALTER TABLE fils DROP produits_id');
    }
}
