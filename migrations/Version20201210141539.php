<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201210141539 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE question_choix_multiples ADD sondage_id INT NOT NULL');
        $this->addSql('ALTER TABLE question_choix_multiples ADD CONSTRAINT FK_9574480FBAF4AE56 FOREIGN KEY (sondage_id) REFERENCES sondage (id)');
        $this->addSql('CREATE INDEX IDX_9574480FBAF4AE56 ON question_choix_multiples (sondage_id)');
        $this->addSql('ALTER TABLE reponse ADD utilisateur_id INT NOT NULL');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT FK_5FB6DEC7FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('CREATE INDEX IDX_5FB6DEC7FB88E14F ON reponse (utilisateur_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE question_choix_multiples DROP FOREIGN KEY FK_9574480FBAF4AE56');
        $this->addSql('DROP INDEX IDX_9574480FBAF4AE56 ON question_choix_multiples');
        $this->addSql('ALTER TABLE question_choix_multiples DROP sondage_id');
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY FK_5FB6DEC7FB88E14F');
        $this->addSql('DROP INDEX IDX_5FB6DEC7FB88E14F ON reponse');
        $this->addSql('ALTER TABLE reponse DROP utilisateur_id');
    }
}
