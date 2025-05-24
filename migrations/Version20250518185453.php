<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250518185453 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE artists (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, picture VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, url LONGTEXT DEFAULT NULL, created_at DATE NOT NULL, slug VARCHAR(255) NOT NULL, video LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE artists_genres (artists_id INT NOT NULL, genres_id INT NOT NULL, INDEX IDX_484E2BBB54A05007 (artists_id), INDEX IDX_484E2BBB6A3B2603 (genres_id), PRIMARY KEY(artists_id, genres_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE concert_details (id INT AUTO_INCREMENT NOT NULL, artist_id INT DEFAULT NULL, scene_id INT DEFAULT NULL, date_id INT DEFAULT NULL, schedule_id INT NOT NULL, created_at DATE NOT NULL, publish TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_E83CB72CB7970CF8 (artist_id), INDEX IDX_E83CB72C166053B4 (scene_id), INDEX IDX_E83CB72CB897366B (date_id), INDEX IDX_E83CB72CA40BC2D5 (schedule_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dates (id INT AUTO_INCREMENT NOT NULL, date DATE NOT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE genres (id INT AUTO_INCREMENT NOT NULL, genre VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE markers (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, latitude DOUBLE PRECISION NOT NULL, longitude DOUBLE PRECISION NOT NULL, popup VARCHAR(255) NOT NULL, icon_url VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE news (id INT AUTO_INCREMENT NOT NULL, type_id INT NOT NULL, title VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, picture VARCHAR(255) NOT NULL, url LONGTEXT DEFAULT NULL, slug VARCHAR(255) NOT NULL, created_at DATE NOT NULL, publish TINYINT(1) NOT NULL, INDEX IDX_1DD39950C54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE news_categories (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, gravity VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE partner_categories (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE partners (id INT AUTO_INCREMENT NOT NULL, type_id INT NOT NULL, name VARCHAR(255) NOT NULL, url LONGTEXT NOT NULL, logo VARCHAR(255) NOT NULL, created_at DATE NOT NULL, slug VARCHAR(255) NOT NULL, publish TINYINT(1) NOT NULL, INDEX IDX_EFEB5164C54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE polygons (id INT AUTO_INCREMENT NOT NULL, coordinates JSON NOT NULL COMMENT \'(DC2Type:json)\', colors VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE refresh_tokens (id INT AUTO_INCREMENT NOT NULL, refresh_token VARCHAR(128) NOT NULL, username VARCHAR(255) NOT NULL, valid DATETIME NOT NULL, UNIQUE INDEX UNIQ_9BACE7E1C74F2195 (refresh_token), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE scenes (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE schedules (id INT AUTO_INCREMENT NOT NULL, schedule VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE artists_genres ADD CONSTRAINT FK_484E2BBB54A05007 FOREIGN KEY (artists_id) REFERENCES artists (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artists_genres ADD CONSTRAINT FK_484E2BBB6A3B2603 FOREIGN KEY (genres_id) REFERENCES genres (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE concert_details ADD CONSTRAINT FK_E83CB72CB7970CF8 FOREIGN KEY (artist_id) REFERENCES artists (id)');
        $this->addSql('ALTER TABLE concert_details ADD CONSTRAINT FK_E83CB72C166053B4 FOREIGN KEY (scene_id) REFERENCES scenes (id)');
        $this->addSql('ALTER TABLE concert_details ADD CONSTRAINT FK_E83CB72CB897366B FOREIGN KEY (date_id) REFERENCES dates (id)');
        $this->addSql('ALTER TABLE concert_details ADD CONSTRAINT FK_E83CB72CA40BC2D5 FOREIGN KEY (schedule_id) REFERENCES schedules (id)');
        $this->addSql('ALTER TABLE news ADD CONSTRAINT FK_1DD39950C54C8C93 FOREIGN KEY (type_id) REFERENCES news_categories (id)');
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
        $this->addSql('ALTER TABLE news DROP FOREIGN KEY FK_1DD39950C54C8C93');
        $this->addSql('ALTER TABLE partners DROP FOREIGN KEY FK_EFEB5164C54C8C93');
        $this->addSql('DROP TABLE artists');
        $this->addSql('DROP TABLE artists_genres');
        $this->addSql('DROP TABLE concert_details');
        $this->addSql('DROP TABLE dates');
        $this->addSql('DROP TABLE genres');
        $this->addSql('DROP TABLE markers');
        $this->addSql('DROP TABLE news');
        $this->addSql('DROP TABLE news_categories');
        $this->addSql('DROP TABLE partner_categories');
        $this->addSql('DROP TABLE partners');
        $this->addSql('DROP TABLE polygons');
        $this->addSql('DROP TABLE refresh_tokens');
        $this->addSql('DROP TABLE scenes');
        $this->addSql('DROP TABLE schedules');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
