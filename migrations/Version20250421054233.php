<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250421054233 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE selected_video (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, instrument_id INT DEFAULT NULL, video_id VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, thumbnail_url VARCHAR(255) NOT NULL, published_at DATETIME DEFAULT NULL, selected_at DATETIME DEFAULT NULL, INDEX IDX_6FE2E177A76ED395 (user_id), INDEX IDX_6FE2E177CF11D9C (instrument_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE selected_video ADD CONSTRAINT FK_6FE2E177A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE selected_video ADD CONSTRAINT FK_6FE2E177CF11D9C FOREIGN KEY (instrument_id) REFERENCES instrument (id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE selected_video DROP FOREIGN KEY FK_6FE2E177A76ED395
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE selected_video DROP FOREIGN KEY FK_6FE2E177CF11D9C
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE selected_video
        SQL);
    }
}
