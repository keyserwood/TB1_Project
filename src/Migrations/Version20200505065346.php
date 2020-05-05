<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200505065346 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE commentaires (id INT AUTO_INCREMENT NOT NULL, articles_id INT DEFAULT NULL, content LONGTEXT DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, username VARCHAR(255) DEFAULT NULL, created_at DATETIME DEFAULT NULL, INDEX IDX_D9BEC0C41EBAF6CC (articles_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commentaires ADD CONSTRAINT FK_D9BEC0C41EBAF6CC FOREIGN KEY (articles_id) REFERENCES articles (id)');
        $this->addSql('ALTER TABLE articles ADD slug VARCHAR(255) DEFAULT NULL, ADD created_at DATETIME DEFAULT NULL, ADD updated_at DATETIME DEFAULT NULL, ADD featured_image VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE users ADD email VARCHAR(180) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE commentaires');
        $this->addSql('ALTER TABLE articles DROP slug, DROP created_at, DROP updated_at, DROP featured_image');
        $this->addSql('ALTER TABLE users DROP email');
    }
}
