<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201210185619 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sondage ADD enqueteur_id INT NOT NULL, ADD sujet_id INT NOT NULL');
        $this->addSql('ALTER TABLE sondage ADD CONSTRAINT FK_7579C89FDB28D7F1 FOREIGN KEY (enqueteur_id) REFERENCES enqueteur (id)');
        $this->addSql('ALTER TABLE sondage ADD CONSTRAINT FK_7579C89F7C4D497E FOREIGN KEY (sujet_id) REFERENCES sujet (id)');
        $this->addSql('CREATE INDEX IDX_7579C89FDB28D7F1 ON sondage (enqueteur_id)');
        $this->addSql('CREATE INDEX IDX_7579C89F7C4D497E ON sondage (sujet_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sondage DROP FOREIGN KEY FK_7579C89FDB28D7F1');
        $this->addSql('ALTER TABLE sondage DROP FOREIGN KEY FK_7579C89F7C4D497E');
        $this->addSql('DROP INDEX IDX_7579C89FDB28D7F1 ON sondage');
        $this->addSql('DROP INDEX IDX_7579C89F7C4D497E ON sondage');
        $this->addSql('ALTER TABLE sondage DROP enqueteur_id, DROP sujet_id');
    }
}
