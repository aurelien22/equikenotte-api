<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210209142907 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE benefit (id INT AUTO_INCREMENT NOT NULL, designation VARCHAR(255) NOT NULL, price_without_tax NUMERIC(6, 2) NOT NULL, tax_rate NUMERIC(4, 2) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE benefit_act (benefit_id INT NOT NULL, act_id INT NOT NULL, INDEX IDX_5057F728B517B89 (benefit_id), INDEX IDX_5057F728D1A55B28 (act_id), PRIMARY KEY(benefit_id, act_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE benefit_act ADD CONSTRAINT FK_5057F728B517B89 FOREIGN KEY (benefit_id) REFERENCES benefit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE benefit_act ADD CONSTRAINT FK_5057F728D1A55B28 FOREIGN KEY (act_id) REFERENCES act (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE benefit_act DROP FOREIGN KEY FK_5057F728B517B89');
        $this->addSql('DROP TABLE benefit');
        $this->addSql('DROP TABLE benefit_act');
    }
}
