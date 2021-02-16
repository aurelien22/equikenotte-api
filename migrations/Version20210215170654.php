<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210215170654 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE appointment (id INT AUTO_INCREMENT NOT NULL, date DATE NOT NULL, start_time TIME NOT NULL, end_time TIME NOT NULL, number_of_horses INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE benefit ADD CONSTRAINT FK_5C8B001F1CE0A142 FOREIGN KEY (dentist_id) REFERENCES dentist (id)');
        $this->addSql('CREATE INDEX IDX_5C8B001F1CE0A142 ON benefit (dentist_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE appointment');
        $this->addSql('ALTER TABLE benefit DROP FOREIGN KEY FK_5C8B001F1CE0A142');
        $this->addSql('DROP INDEX IDX_5C8B001F1CE0A142 ON benefit');
    }
}
