<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250414120730 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE contribution (id INT AUTO_INCREMENT NOT NULL, instrument_id INT NOT NULL, user_id INT NOT NULL, title VARCHAR(255) NOT NULL, style VARCHAR(255) DEFAULT NULL, type_contribution VARCHAR(10) NOT NULL, upload VARCHAR(255) NOT NULL, external_url VARCHAR(255) DEFAULT NULL, image_url VARCHAR(255) DEFAULT NULL, bpm SMALLINT DEFAULT NULL, format VARCHAR(3) NOT NULL, key_contrib VARCHAR(3) DEFAULT NULL, duration INT DEFAULT NULL, description VARCHAR(2000) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', is_approved TINYINT(1) NOT NULL, INDEX IDX_EA351E15CF11D9C (instrument_id), INDEX IDX_EA351E15A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE contribution ADD CONSTRAINT FK_EA351E15CF11D9C FOREIGN KEY (instrument_id) REFERENCES instrument (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE contribution ADD CONSTRAINT FK_EA351E15A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE contribution DROP FOREIGN KEY FK_EA351E15CF11D9C
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE contribution DROP FOREIGN KEY FK_EA351E15A76ED395
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE contribution
        SQL);
    }
}
