<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250416105852 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE selected_video ADD user_id INT DEFAULT NULL, ADD instrument_id INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE selected_video ADD CONSTRAINT FK_6FE2E177A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE selected_video ADD CONSTRAINT FK_6FE2E177CF11D9C FOREIGN KEY (instrument_id) REFERENCES instrument (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_6FE2E177A76ED395 ON selected_video (user_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_6FE2E177CF11D9C ON selected_video (instrument_id)
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
            DROP INDEX IDX_6FE2E177A76ED395 ON selected_video
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_6FE2E177CF11D9C ON selected_video
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE selected_video DROP user_id, DROP instrument_id
        SQL);
    }
}
