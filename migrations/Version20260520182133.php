<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260520182133 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create the first entities (events, action list, permission, role and user.';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE action_lists (identifier UUID NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, name VARCHAR(120) NOT NULL, slug VARCHAR(160) NOT NULL, description TEXT DEFAULT NULL, PRIMARY KEY (identifier))');
        $this->addSql('CREATE TABLE events (identifier UUID NOT NULL, organizer_identifier UUID NOT NULL, title VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, banner VARCHAR(2048) DEFAULT NULL, location_name VARCHAR(255) NOT NULL, location_address VARCHAR(255) NOT NULL, location_city VARCHAR(120) NOT NULL, location_state VARCHAR(80) NOT NULL, location_zipcode VARCHAR(20) DEFAULT NULL, latitude DOUBLE PRECISION DEFAULT NULL, longitude DOUBLE PRECISION DEFAULT NULL, start_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, end_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, sales_start_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, sales_end_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, published_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, status VARCHAR(255) NOT NULL, visibility VARCHAR(255) NOT NULL, max_tickets INT DEFAULT NULL, created_by UUID DEFAULT NULL, updated_by UUID DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY (identifier))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5387574A989D9B62 ON events (slug)');
        $this->addSql('CREATE TABLE permissions (identifier UUID NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, name VARCHAR(120) NOT NULL, slug VARCHAR(160) NOT NULL, description TEXT DEFAULT NULL, PRIMARY KEY (identifier))');
        $this->addSql('CREATE TABLE roles (identifier UUID NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, name VARCHAR(120) NOT NULL, slug VARCHAR(120) NOT NULL, description TEXT DEFAULT NULL, is_system BOOLEAN NOT NULL, PRIMARY KEY (identifier))');
        $this->addSql('CREATE TABLE users (identifier UUID NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, name VARCHAR(160) NOT NULL, email VARCHAR(180) NOT NULL, password VARCHAR(255) NOT NULL, email_verified_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, last_login_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, is_active BOOLEAN NOT NULL, role_identifier UUID NOT NULL, PRIMARY KEY (identifier))');
        $this->addSql('CREATE INDEX IDX_1483A5E9F81AE946 ON users (role_identifier)');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E9F81AE946 FOREIGN KEY (role_identifier) REFERENCES roles (identifier) NOT DEFERRABLE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE users DROP CONSTRAINT FK_1483A5E9F81AE946');
        $this->addSql('DROP TABLE action_lists');
        $this->addSql('DROP TABLE events');
        $this->addSql('DROP TABLE permissions');
        $this->addSql('DROP TABLE roles');
        $this->addSql('DROP TABLE users');
    }
}
