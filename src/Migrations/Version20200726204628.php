<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200726204628 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE usuario (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2265B05DF85E0677 ON usuario (username)');
        $this->addSql('DROP INDEX IDX_34E5914C3BA9BFA5');
        $this->addSql('CREATE TEMPORARY TABLE __temp__medico AS SELECT id, especialidade_id, crm, nome FROM medico');
        $this->addSql('DROP TABLE medico');
        $this->addSql('CREATE TABLE medico (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, especialidade_id INTEGER NOT NULL, crm VARCHAR(255) NOT NULL COLLATE BINARY, nome VARCHAR(255) NOT NULL COLLATE BINARY, CONSTRAINT FK_34E5914C3BA9BFA5 FOREIGN KEY (especialidade_id) REFERENCES especialidade (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO medico (id, especialidade_id, crm, nome) SELECT id, especialidade_id, crm, nome FROM __temp__medico');
        $this->addSql('DROP TABLE __temp__medico');
        $this->addSql('CREATE INDEX IDX_34E5914C3BA9BFA5 ON medico (especialidade_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE usuario');
        $this->addSql('DROP INDEX IDX_34E5914C3BA9BFA5');
        $this->addSql('CREATE TEMPORARY TABLE __temp__medico AS SELECT id, especialidade_id, crm, nome FROM medico');
        $this->addSql('DROP TABLE medico');
        $this->addSql('CREATE TABLE medico (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, especialidade_id INTEGER NOT NULL, crm VARCHAR(255) NOT NULL, nome VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO medico (id, especialidade_id, crm, nome) SELECT id, especialidade_id, crm, nome FROM __temp__medico');
        $this->addSql('DROP TABLE __temp__medico');
        $this->addSql('CREATE INDEX IDX_34E5914C3BA9BFA5 ON medico (especialidade_id)');
    }
}
