<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241118195531 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE artists (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, picture VARBINARY(255) NOT NULL, content LONGTEXT NOT NULL, url LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', slug VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE artists_genres (artists_id INT NOT NULL, genres_id INT NOT NULL, INDEX IDX_484E2BBB54A05007 (artists_id), INDEX IDX_484E2BBB6A3B2603 (genres_id), PRIMARY KEY(artists_id, genres_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE concert_details (id INT AUTO_INCREMENT NOT NULL, artist_id INT DEFAULT NULL, scene_id INT DEFAULT NULL, date_id INT DEFAULT NULL, schedule_id INT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_E83CB72CB7970CF8 (artist_id), INDEX IDX_E83CB72C166053B4 (scene_id), INDEX IDX_E83CB72CB897366B (date_id), INDEX IDX_E83CB72CA40BC2D5 (schedule_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dates (id INT AUTO_INCREMENT NOT NULL, date DATE NOT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE genres (id INT AUTO_INCREMENT NOT NULL, genre VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE partner_categories (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE partners (id INT AUTO_INCREMENT NOT NULL, type_id INT NOT NULL, name VARCHAR(255) NOT NULL, url LONGTEXT NOT NULL, logo VARBINARY(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_EFEB5164C54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE scenes (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE schedules (id INT AUTO_INCREMENT NOT NULL, schedule VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE artists_genres ADD CONSTRAINT FK_484E2BBB54A05007 FOREIGN KEY (artists_id) REFERENCES artists (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artists_genres ADD CONSTRAINT FK_484E2BBB6A3B2603 FOREIGN KEY (genres_id) REFERENCES genres (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE concert_details ADD CONSTRAINT FK_E83CB72CB7970CF8 FOREIGN KEY (artist_id) REFERENCES artists (id)');
        $this->addSql('ALTER TABLE concert_details ADD CONSTRAINT FK_E83CB72C166053B4 FOREIGN KEY (scene_id) REFERENCES scenes (id)');
        $this->addSql('ALTER TABLE concert_details ADD CONSTRAINT FK_E83CB72CB897366B FOREIGN KEY (date_id) REFERENCES dates (id)');
        $this->addSql('ALTER TABLE concert_details ADD CONSTRAINT FK_E83CB72CA40BC2D5 FOREIGN KEY (schedule_id) REFERENCES schedules (id)');
        $this->addSql('ALTER TABLE partners ADD CONSTRAINT FK_EFEB5164C54C8C93 FOREIGN KEY (type_id) REFERENCES partner_categories (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE artists_genres DROP FOREIGN KEY FK_484E2BBB54A05007');
        $this->addSql('ALTER TABLE artists_genres DROP FOREIGN KEY FK_484E2BBB6A3B2603');
        $this->addSql('ALTER TABLE concert_details DROP FOREIGN KEY FK_E83CB72CB7970CF8');
        $this->addSql('ALTER TABLE concert_details DROP FOREIGN KEY FK_E83CB72C166053B4');
        $this->addSql('ALTER TABLE concert_details DROP FOREIGN KEY FK_E83CB72CB897366B');
        $this->addSql('ALTER TABLE concert_details DROP FOREIGN KEY FK_E83CB72CA40BC2D5');
        $this->addSql('ALTER TABLE partners DROP FOREIGN KEY FK_EFEB5164C54C8C93');
        $this->addSql('DROP TABLE artists');
        $this->addSql('DROP TABLE artists_genres');
        $this->addSql('DROP TABLE concert_details');
        $this->addSql('DROP TABLE dates');
        $this->addSql('DROP TABLE genres');
        $this->addSql('DROP TABLE partner_categories');
        $this->addSql('DROP TABLE partners');
        $this->addSql('DROP TABLE scenes');
        $this->addSql('DROP TABLE schedules');
    }
}
