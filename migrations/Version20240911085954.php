<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240911085954 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pistolets ADD produits_id INT NOT NULL');
        $this->addSql('ALTER TABLE pistolets ADD CONSTRAINT FK_32ECD412CD11A2CF FOREIGN KEY (produits_id) REFERENCES produits (id)');
        $this->addSql('CREATE INDEX IDX_32ECD412CD11A2CF ON pistolets (produits_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pistolets DROP FOREIGN KEY FK_32ECD412CD11A2CF');
        $this->addSql('DROP INDEX IDX_32ECD412CD11A2CF ON pistolets');
        $this->addSql('ALTER TABLE pistolets DROP produits_id');
    }
}
