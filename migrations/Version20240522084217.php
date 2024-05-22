<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240522084217 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lista_productos DROP FOREIGN KEY FK_9BD9253DDE734E51');
        $this->addSql('DROP INDEX IDX_9BD9253DDE734E51 ON lista_productos');
        $this->addSql('ALTER TABLE lista_productos DROP cliente_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lista_productos ADD cliente_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE lista_productos ADD CONSTRAINT FK_9BD9253DDE734E51 FOREIGN KEY (cliente_id) REFERENCES cliente (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_9BD9253DDE734E51 ON lista_productos (cliente_id)');
    }
}
