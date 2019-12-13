<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191213230132 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE figure_figure (figure_source INT NOT NULL, figure_target INT NOT NULL, INDEX IDX_704016F49DDAFD (figure_source), INDEX IDX_704016F419788A72 (figure_target), PRIMARY KEY(figure_source, figure_target)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE figure_figure ADD CONSTRAINT FK_704016F49DDAFD FOREIGN KEY (figure_source) REFERENCES figure (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE figure_figure ADD CONSTRAINT FK_704016F419788A72 FOREIGN KEY (figure_target) REFERENCES figure (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE figure_figure');
    }
}
