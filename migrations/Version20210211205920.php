<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210211205920 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE item_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE to_do_list_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE item (id INT NOT NULL, todolist_id INT NOT NULL, content VARCHAR(255) NOT NULL, creation_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_1F1B251EAD16642A ON item (todolist_id)');
        $this->addSql('COMMENT ON COLUMN item.creation_date IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE to_do_list (id INT NOT NULL, creator_id INT NOT NULL, name VARCHAR(255) NOT NULL, last_item_creation TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_4A6048EC61220EA6 ON to_do_list (creator_id)');
        $this->addSql('COMMENT ON COLUMN to_do_list.last_item_creation IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE item ADD CONSTRAINT FK_1F1B251EAD16642A FOREIGN KEY (todolist_id) REFERENCES to_do_list (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE to_do_list ADD CONSTRAINT FK_4A6048EC61220EA6 FOREIGN KEY (creator_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE item DROP CONSTRAINT FK_1F1B251EAD16642A');
        $this->addSql('DROP SEQUENCE item_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE to_do_list_id_seq CASCADE');
        $this->addSql('DROP TABLE item');
        $this->addSql('DROP TABLE to_do_list');
    }
}
