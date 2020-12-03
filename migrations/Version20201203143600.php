<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201203143600 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY FK_5FB6DEC7FB88E14F');
        $this->addSql('CREATE TABLE `option` (id INT AUTO_INCREMENT NOT NULL, question_id INT DEFAULT NULL, contenue VARCHAR(255) DEFAULT NULL, INDEX IDX_5A8600B01E27F6BF (question_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sujets (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) DEFAULT NULL, titre VARCHAR(255) DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `option` ADD CONSTRAINT FK_5A8600B01E27F6BF FOREIGN KEY (question_id) REFERENCES question (id)');
        $this->addSql('DROP TABLE remuneration');
        $this->addSql('DROP TABLE reponse');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('ALTER TABLE cadeau ADD image VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE nouveau_type CHANGE nom nom VARCHAR(255) DEFAULT NULL, CHANGE offre offre VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE question DROP FOREIGN KEY FK_B6F7494E65C3BD4A');
        $this->addSql('DROP INDEX IDX_B6F7494E65C3BD4A ON question');
        $this->addSql('ALTER TABLE question CHANGE sondages_id sondage_id INT NOT NULL');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494EBAF4AE56 FOREIGN KEY (sondage_id) REFERENCES sondage (id)');
        $this->addSql('CREATE INDEX IDX_B6F7494EBAF4AE56 ON question (sondage_id)');
        $this->addSql('ALTER TABLE remise CHANGE pourcentage pourcentage DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE sondage DROP FOREIGN KEY FK_7579C89F50B0AC57');
        $this->addSql('ALTER TABLE sondage DROP FOREIGN KEY FK_7579C89F6EECD166');
        $this->addSql('ALTER TABLE sondage DROP FOREIGN KEY FK_7579C89F855D09F1');
        $this->addSql('ALTER TABLE sondage DROP FOREIGN KEY FK_7579C89FDA7CA8F0');
        $this->addSql('DROP INDEX UNIQ_7579C89F6EECD166 ON sondage');
        $this->addSql('DROP INDEX UNIQ_7579C89FDA7CA8F0 ON sondage');
        $this->addSql('DROP INDEX UNIQ_7579C89F855D09F1 ON sondage');
        $this->addSql('DROP INDEX UNIQ_7579C89F50B0AC57 ON sondage');
        $this->addSql('ALTER TABLE sondage DROP sujets_id, DROP remises_id, DROP cadeaux_id, DROP nouveaux_id, CHANGE titre titre VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE sujet CHANGE updated_at updated_at DATETIME NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE remuneration (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE reponse (id INT AUTO_INCREMENT NOT NULL, questions_id INT DEFAULT NULL, utilisateur_id INT DEFAULT NULL, contenue VARCHAR(2000) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_5FB6DEC7FB88E14F (utilisateur_id), INDEX IDX_5FB6DEC7BCB134CE (questions_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, prenom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, date_naissance DATE NOT NULL, email VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, numtel INT NOT NULL, adresse VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, type VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, mot_de_passe VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, matricule_fisc VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, logo VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, registre_com VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT FK_5FB6DEC7BCB134CE FOREIGN KEY (questions_id) REFERENCES question (id)');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT FK_5FB6DEC7FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('DROP TABLE `option`');
        $this->addSql('DROP TABLE sujets');
        $this->addSql('ALTER TABLE cadeau DROP image');
        $this->addSql('ALTER TABLE nouveau_type CHANGE nom nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE offre offre VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE question DROP FOREIGN KEY FK_B6F7494EBAF4AE56');
        $this->addSql('DROP INDEX IDX_B6F7494EBAF4AE56 ON question');
        $this->addSql('ALTER TABLE question CHANGE sondage_id sondages_id INT NOT NULL');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494E65C3BD4A FOREIGN KEY (sondages_id) REFERENCES sondage (id)');
        $this->addSql('CREATE INDEX IDX_B6F7494E65C3BD4A ON question (sondages_id)');
        $this->addSql('ALTER TABLE remise CHANGE pourcentage pourcentage INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sondage ADD sujets_id INT DEFAULT NULL, ADD remises_id INT DEFAULT NULL, ADD cadeaux_id INT DEFAULT NULL, ADD nouveaux_id INT DEFAULT NULL, CHANGE titre titre VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE sondage ADD CONSTRAINT FK_7579C89F50B0AC57 FOREIGN KEY (sujets_id) REFERENCES sujet (id)');
        $this->addSql('ALTER TABLE sondage ADD CONSTRAINT FK_7579C89F6EECD166 FOREIGN KEY (remises_id) REFERENCES remise (id)');
        $this->addSql('ALTER TABLE sondage ADD CONSTRAINT FK_7579C89F855D09F1 FOREIGN KEY (nouveaux_id) REFERENCES nouveau_type (id)');
        $this->addSql('ALTER TABLE sondage ADD CONSTRAINT FK_7579C89FDA7CA8F0 FOREIGN KEY (cadeaux_id) REFERENCES cadeau (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7579C89F6EECD166 ON sondage (remises_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7579C89FDA7CA8F0 ON sondage (cadeaux_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7579C89F855D09F1 ON sondage (nouveaux_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7579C89F50B0AC57 ON sondage (sujets_id)');
        $this->addSql('ALTER TABLE sujet CHANGE updated_at updated_at DATE NOT NULL');
    }
}
