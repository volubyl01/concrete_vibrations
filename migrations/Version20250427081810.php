<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250427081810 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            DROP INDEX `primary` ON role_user
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE role_user ADD PRIMARY KEY (user_id, role_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            DROP INDEX `PRIMARY` ON role_user
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE role_user ADD PRIMARY KEY (role_id, user_id)
        SQL);
    }
}
