<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241222151708 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE artists ADD created_at DATE NOT NULL');
        $this->addSql('ALTER TABLE concert_details ADD created_at VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE news ADD title VARCHAR(255) NOT NULL, ADD content LONGTEXT NOT NULL, ADD picture VARCHAR(255) NOT NULL, ADD url LONGTEXT DEFAULT NULL, ADD slug VARCHAR(255) NOT NULL, ADD created_at DATE NOT NULL');
        $this->addSql('ALTER TABLE partners ADD created_at DATE NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE artists DROP created_at');
        $this->addSql('ALTER TABLE partners DROP created_at');
        $this->addSql('ALTER TABLE news DROP title, DROP content, DROP picture, DROP url, DROP slug, DROP created_at');
        $this->addSql('ALTER TABLE concert_details DROP created_at');
    }
}
