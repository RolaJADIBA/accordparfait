<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220801225841 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE numerique_image DROP FOREIGN KEY FK_40E184A993C1F9F0');
        $this->addSql('DROP INDEX IDX_40E184A993C1F9F0 ON numerique_image');
        $this->addSql('ALTER TABLE numerique_image DROP numerique_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE numerique_image ADD numerique_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE numerique_image ADD CONSTRAINT FK_40E184A993C1F9F0 FOREIGN KEY (numerique_id) REFERENCES numerique (id)');
        $this->addSql('CREATE INDEX IDX_40E184A993C1F9F0 ON numerique_image (numerique_id)');
    }
}
