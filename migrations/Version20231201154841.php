<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231201154841 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE action (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prix INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cours_action (id INT AUTO_INCREMENT NOT NULL, one_action_id INT DEFAULT NULL, date_cours_action DATETIME NOT NULL, prix INT NOT NULL, INDEX IDX_284C9DFAF533F5DB (one_action_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE trader (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transaction (id INT AUTO_INCREMENT NOT NULL, one_trader_id INT DEFAULT NULL, one_action_id INT DEFAULT NULL, date_transaction DATETIME NOT NULL, quantite INT NOT NULL, operation VARCHAR(255) NOT NULL, INDEX IDX_723705D17A729361 (one_trader_id), INDEX IDX_723705D1F533F5DB (one_action_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cours_action ADD CONSTRAINT FK_284C9DFAF533F5DB FOREIGN KEY (one_action_id) REFERENCES action (id)');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D17A729361 FOREIGN KEY (one_trader_id) REFERENCES trader (id)');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D1F533F5DB FOREIGN KEY (one_action_id) REFERENCES action (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cours_action DROP FOREIGN KEY FK_284C9DFAF533F5DB');
        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D17A729361');
        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D1F533F5DB');
        $this->addSql('DROP TABLE action');
        $this->addSql('DROP TABLE cours_action');
        $this->addSql('DROP TABLE trader');
        $this->addSql('DROP TABLE transaction');
    }
}
