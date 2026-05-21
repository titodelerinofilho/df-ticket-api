<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260521201803 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create order, organizer and ticket type entity.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE orders (identifier UUID NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, code VARCHAR(40) NOT NULL, subtotal NUMERIC(10, 2) NOT NULL, discount NUMERIC(10, 2) NOT NULL, tax NUMERIC(10, 2) NOT NULL, total NUMERIC(10, 2) NOT NULL, status VARCHAR(255) NOT NULL, expires_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, paid_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, canceled_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, user_identifier UUID NOT NULL, event_identifier UUID NOT NULL, PRIMARY KEY (identifier))');
        $this->addSql('CREATE INDEX IDX_E52FFDEED0494586 ON orders (user_identifier)');
        $this->addSql('CREATE INDEX IDX_E52FFDEE2FC05A45 ON orders (event_identifier)');
        $this->addSql('CREATE TABLE organizers (identifier UUID NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, name VARCHAR(180) NOT NULL, slug VARCHAR(180) NOT NULL, document VARCHAR(40) DEFAULT NULL, email VARCHAR(180) NOT NULL, phone VARCHAR(40) DEFAULT NULL, website VARCHAR(255) DEFAULT NULL, logo VARCHAR(2048) DEFAULT NULL, description TEXT DEFAULT NULL, is_active BOOLEAN NOT NULL, owner_identifier UUID NOT NULL, PRIMARY KEY (identifier))');
        $this->addSql('CREATE INDEX IDX_D29B3BFC25441A2F ON organizers (owner_identifier)');
        $this->addSql('CREATE TABLE ticket_types (identifier UUID NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, name VARCHAR(120) NOT NULL, description TEXT DEFAULT NULL, price NUMERIC(10, 2) NOT NULL, quantity INT NOT NULL, max_per_order INT DEFAULT NULL, sales_start_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, sales_end_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, status VARCHAR(255) NOT NULL, event_identifier UUID NOT NULL, PRIMARY KEY (identifier))');
        $this->addSql('CREATE INDEX IDX_7100EABB2FC05A45 ON ticket_types (event_identifier)');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT fk_order_user_identifier FOREIGN KEY (user_identifier) REFERENCES users (identifier) NOT DEFERRABLE');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT fk_order_event_identifier FOREIGN KEY (event_identifier) REFERENCES events (identifier) NOT DEFERRABLE');
        $this->addSql('ALTER TABLE organizers ADD CONSTRAINT fk_organizer_owner_identifier FOREIGN KEY (owner_identifier) REFERENCES users (identifier) NOT DEFERRABLE');
        $this->addSql('ALTER TABLE ticket_types ADD CONSTRAINT fk_ticket_type_event_identifier FOREIGN KEY (event_identifier) REFERENCES events (identifier) NOT DEFERRABLE');
        $this->addSql('ALTER TABLE events ADD created_by_identifier UUID DEFAULT NULL');
        $this->addSql('ALTER TABLE events ADD updated_by_identifier UUID DEFAULT NULL');
        $this->addSql('ALTER TABLE events DROP created_by');
        $this->addSql('ALTER TABLE events DROP updated_by');
        $this->addSql('ALTER TABLE events ADD CONSTRAINT fk_event_organizer_identifier FOREIGN KEY (organizer_identifier) REFERENCES organizers (identifier) NOT DEFERRABLE');
        $this->addSql('CREATE INDEX IDX_5387574A130A16A9 ON events (organizer_identifier)');
        $this->addSql('ALTER TABLE permissions ADD effect VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE permissions ADD role_identifier UUID NOT NULL');
        $this->addSql('ALTER TABLE permissions ADD action_list_identifier UUID NOT NULL');
        $this->addSql('ALTER TABLE permissions DROP name');
        $this->addSql('ALTER TABLE permissions DROP slug');
        $this->addSql('ALTER TABLE permissions DROP description');
        $this->addSql('ALTER TABLE permissions ADD CONSTRAINT fk_permission_role_identifier FOREIGN KEY (role_identifier) REFERENCES roles (identifier) NOT DEFERRABLE');
        $this->addSql('ALTER TABLE permissions ADD CONSTRAINT fk_permission_action_list_identifier FOREIGN KEY (action_list_identifier) REFERENCES action_lists (identifier) NOT DEFERRABLE');
        $this->addSql('CREATE INDEX IDX_2DEDCC6FF81AE946 ON permissions (role_identifier)');
        $this->addSql('CREATE INDEX IDX_2DEDCC6FCE11A1C1 ON permissions (action_list_identifier)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE orders DROP CONSTRAINT fk_order_user_identifier');
        $this->addSql('ALTER TABLE orders DROP CONSTRAINT fk_order_event_identifier');
        $this->addSql('ALTER TABLE organizers DROP CONSTRAINT fk_organizer_owner_identifier');
        $this->addSql('ALTER TABLE ticket_types DROP CONSTRAINT fk_ticket_type_event_identifier');
        $this->addSql('DROP TABLE orders');
        $this->addSql('DROP TABLE organizers');
        $this->addSql('DROP TABLE ticket_types');
        $this->addSql('ALTER TABLE events DROP CONSTRAINT fk_event_organizer_identifier');
        $this->addSql('DROP INDEX IDX_5387574A130A16A9');
        $this->addSql('ALTER TABLE events ADD created_by UUID DEFAULT NULL');
        $this->addSql('ALTER TABLE events ADD updated_by UUID DEFAULT NULL');
        $this->addSql('ALTER TABLE events DROP created_by_identifier');
        $this->addSql('ALTER TABLE events DROP updated_by_identifier');
        $this->addSql('ALTER TABLE permissions DROP CONSTRAINT fk_permission_role_identifier');
        $this->addSql('ALTER TABLE permissions DROP CONSTRAINT fk_permission_action_list_identifier');
        $this->addSql('DROP INDEX IDX_2DEDCC6FF81AE946');
        $this->addSql('DROP INDEX IDX_2DEDCC6FCE11A1C1');
        $this->addSql('ALTER TABLE permissions ADD name VARCHAR(120) NOT NULL');
        $this->addSql('ALTER TABLE permissions ADD slug VARCHAR(160) NOT NULL');
        $this->addSql('ALTER TABLE permissions ADD description TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE permissions DROP effect');
        $this->addSql('ALTER TABLE permissions DROP role_identifier');
        $this->addSql('ALTER TABLE permissions DROP action_list_identifier');
    }
}
