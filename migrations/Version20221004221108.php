<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221004221108 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE recipe CHANGE title title VARCHAR(100) DEFAULT NULL, CHANGE description description LONGTEXT DEFAULT NULL, CHANGE photos photos LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\'');
        $this->addSql('ALTER TABLE user DROP name');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE recipe CHANGE title title VARCHAR(100) NOT NULL, CHANGE description description LONGTEXT NOT NULL, CHANGE photos photos JSON NOT NULL');
        $this->addSql('ALTER TABLE user ADD name VARCHAR(255) NOT NULL');
    }
}
