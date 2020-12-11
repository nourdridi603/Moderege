<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201210140729 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE choix_reponse (id INT AUTO_INCREMENT NOT NULL, question_choix_multiples_id INT NOT NULL, text VARCHAR(255) NOT NULL, INDEX IDX_796A26BE2D5F2B0 (question_choix_multiples_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE question_choix_multiples (id INT AUTO_INCREMENT NOT NULL, contenu VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reponse (id INT AUTO_INCREMENT NOT NULL, question_logique_id INT DEFAULT NULL, question_multi_choix_id INT DEFAULT NULL, contenu VARCHAR(255) NOT NULL, INDEX IDX_5FB6DEC76CEB5729 (question_logique_id), INDEX IDX_5FB6DEC7FAEBE406 (question_multi_choix_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE choix_reponse ADD CONSTRAINT FK_796A26BE2D5F2B0 FOREIGN KEY (question_choix_multiples_id) REFERENCES question_choix_multiples (id)');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT FK_5FB6DEC76CEB5729 FOREIGN KEY (question_logique_id) REFERENCES question (id)');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT FK_5FB6DEC7FAEBE406 FOREIGN KEY (question_multi_choix_id) REFERENCES question_choix_multiples (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE choix_reponse DROP FOREIGN KEY FK_796A26BE2D5F2B0');
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY FK_5FB6DEC7FAEBE406');
        $this->addSql('DROP TABLE choix_reponse');
        $this->addSql('DROP TABLE question_choix_multiples');
        $this->addSql('DROP TABLE reponse');
    }
}
