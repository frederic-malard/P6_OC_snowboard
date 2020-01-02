<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200102114610 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE figure (id INT AUTO_INCREMENT NOT NULL, editeur_id INT DEFAULT NULL, groupe_id INT NOT NULL, nom VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, slug VARCHAR(255) NOT NULL, date_creation DATETIME NOT NULL, date_modification DATETIME DEFAULT NULL, INDEX IDX_2F57B37A3375BD21 (editeur_id), INDEX IDX_2F57B37A7A45358C (groupe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE figure_figure (figure_source INT NOT NULL, figure_target INT NOT NULL, INDEX IDX_704016F49DDAFD (figure_source), INDEX IDX_704016F419788A72 (figure_target), PRIMARY KEY(figure_source, figure_target)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE difficulte (id INT AUTO_INCREMENT NOT NULL, notant_id INT NOT NULL, figure_id INT NOT NULL, note INT NOT NULL, INDEX IDX_AF6A33A0FBB3368D (notant_id), INDEX IDX_AF6A33A05C011B5 (figure_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, login VARCHAR(255) NOT NULL, mot_de_passe VARCHAR(255) NOT NULL, mail VARCHAR(255) NOT NULL, role VARCHAR(255) NOT NULL, avatar VARCHAR(255) DEFAULT NULL, slug VARCHAR(255) NOT NULL, a_verifier VARCHAR(255) DEFAULT NULL, reinitialisation VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur_figure (utilisateur_id INT NOT NULL, figure_id INT NOT NULL, INDEX IDX_4EFA89F1FB88E14F (utilisateur_id), INDEX IDX_4EFA89F15C011B5 (figure_id), PRIMARY KEY(utilisateur_id, figure_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commentaire (id INT AUTO_INCREMENT NOT NULL, auteur_id INT DEFAULT NULL, figure_id INT NOT NULL, date_creation DATETIME NOT NULL, contenu LONGTEXT NOT NULL, signale TINYINT(1) DEFAULT NULL, INDEX IDX_67F068BC60BB6FE6 (auteur_id), INDEX IDX_67F068BC5C011B5 (figure_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE illustration (id INT AUTO_INCREMENT NOT NULL, figure_id INT NOT NULL, url VARCHAR(255) NOT NULL, alt VARCHAR(255) DEFAULT NULL, INDEX IDX_D67B9A425C011B5 (figure_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE video (id INT AUTO_INCREMENT NOT NULL, figure_id INT NOT NULL, url VARCHAR(255) NOT NULL, alt VARCHAR(255) DEFAULT NULL, INDEX IDX_7CC7DA2C5C011B5 (figure_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE groupe (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE figure ADD CONSTRAINT FK_2F57B37A3375BD21 FOREIGN KEY (editeur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE figure ADD CONSTRAINT FK_2F57B37A7A45358C FOREIGN KEY (groupe_id) REFERENCES groupe (id)');
        $this->addSql('ALTER TABLE figure_figure ADD CONSTRAINT FK_704016F49DDAFD FOREIGN KEY (figure_source) REFERENCES figure (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE figure_figure ADD CONSTRAINT FK_704016F419788A72 FOREIGN KEY (figure_target) REFERENCES figure (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE difficulte ADD CONSTRAINT FK_AF6A33A0FBB3368D FOREIGN KEY (notant_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE difficulte ADD CONSTRAINT FK_AF6A33A05C011B5 FOREIGN KEY (figure_id) REFERENCES figure (id)');
        $this->addSql('ALTER TABLE utilisateur_figure ADD CONSTRAINT FK_4EFA89F1FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE utilisateur_figure ADD CONSTRAINT FK_4EFA89F15C011B5 FOREIGN KEY (figure_id) REFERENCES figure (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC60BB6FE6 FOREIGN KEY (auteur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC5C011B5 FOREIGN KEY (figure_id) REFERENCES figure (id)');
        $this->addSql('ALTER TABLE illustration ADD CONSTRAINT FK_D67B9A425C011B5 FOREIGN KEY (figure_id) REFERENCES figure (id)');
        $this->addSql('ALTER TABLE video ADD CONSTRAINT FK_7CC7DA2C5C011B5 FOREIGN KEY (figure_id) REFERENCES figure (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE figure_figure DROP FOREIGN KEY FK_704016F49DDAFD');
        $this->addSql('ALTER TABLE figure_figure DROP FOREIGN KEY FK_704016F419788A72');
        $this->addSql('ALTER TABLE difficulte DROP FOREIGN KEY FK_AF6A33A05C011B5');
        $this->addSql('ALTER TABLE utilisateur_figure DROP FOREIGN KEY FK_4EFA89F15C011B5');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC5C011B5');
        $this->addSql('ALTER TABLE illustration DROP FOREIGN KEY FK_D67B9A425C011B5');
        $this->addSql('ALTER TABLE video DROP FOREIGN KEY FK_7CC7DA2C5C011B5');
        $this->addSql('ALTER TABLE figure DROP FOREIGN KEY FK_2F57B37A3375BD21');
        $this->addSql('ALTER TABLE difficulte DROP FOREIGN KEY FK_AF6A33A0FBB3368D');
        $this->addSql('ALTER TABLE utilisateur_figure DROP FOREIGN KEY FK_4EFA89F1FB88E14F');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC60BB6FE6');
        $this->addSql('ALTER TABLE figure DROP FOREIGN KEY FK_2F57B37A7A45358C');
        $this->addSql('DROP TABLE figure');
        $this->addSql('DROP TABLE figure_figure');
        $this->addSql('DROP TABLE difficulte');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('DROP TABLE utilisateur_figure');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('DROP TABLE illustration');
        $this->addSql('DROP TABLE video');
        $this->addSql('DROP TABLE groupe');
    }
}
