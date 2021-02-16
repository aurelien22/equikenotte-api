<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210215171324 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE appointment ADD dentist_id INT NOT NULL, ADD customer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE appointment ADD CONSTRAINT FK_FE38F8441CE0A142 FOREIGN KEY (dentist_id) REFERENCES dentist (id)');
        $this->addSql('ALTER TABLE appointment ADD CONSTRAINT FK_FE38F8449395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('CREATE INDEX IDX_FE38F8441CE0A142 ON appointment (dentist_id)');
        $this->addSql('CREATE INDEX IDX_FE38F8449395C3F3 ON appointment (customer_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE appointment DROP FOREIGN KEY FK_FE38F8441CE0A142');
        $this->addSql('ALTER TABLE appointment DROP FOREIGN KEY FK_FE38F8449395C3F3');
        $this->addSql('DROP INDEX IDX_FE38F8441CE0A142 ON appointment');
        $this->addSql('DROP INDEX IDX_FE38F8449395C3F3 ON appointment');
        $this->addSql('ALTER TABLE appointment DROP dentist_id, DROP customer_id');
    }
}
