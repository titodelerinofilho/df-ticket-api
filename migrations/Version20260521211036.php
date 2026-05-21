<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260521211036 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE audit_logs (identifier UUID NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, entity VARCHAR(120) NOT NULL, entity_identifier UUID NOT NULL, action VARCHAR(80) NOT NULL, old_values JSON DEFAULT NULL, new_values JSON DEFAULT NULL, ip_address VARCHAR(45) DEFAULT NULL, user_agent TEXT DEFAULT NULL, user_identifier UUID DEFAULT NULL, PRIMARY KEY (identifier))');
        $this->addSql('CREATE INDEX IDX_D62F2858D0494586 ON audit_logs (user_identifier)');
        $this->addSql('CREATE TABLE check_ins (identifier UUID NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, checked_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, device_info TEXT DEFAULT NULL, ip_address VARCHAR(45) DEFAULT NULL, ticket_identifier UUID NOT NULL, checked_by_identifier UUID DEFAULT NULL, PRIMARY KEY (identifier))');
        $this->addSql('CREATE INDEX IDX_DFFFC3DFE1BD113E ON check_ins (ticket_identifier)');
        $this->addSql('CREATE INDEX IDX_DFFFC3DF27A351BA ON check_ins (checked_by_identifier)');
        $this->addSql('CREATE TABLE coupons (identifier UUID NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, code VARCHAR(80) NOT NULL, description TEXT DEFAULT NULL, type VARCHAR(255) NOT NULL, value NUMERIC(10, 2) NOT NULL, max_uses INT DEFAULT NULL, used_count INT NOT NULL, starts_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, ends_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, is_active BOOLEAN NOT NULL, event_identifier UUID DEFAULT NULL, PRIMARY KEY (identifier))');
        $this->addSql('CREATE INDEX IDX_F56411182FC05A45 ON coupons (event_identifier)');
        $this->addSql('CREATE TABLE order_items (identifier UUID NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, quantity INT NOT NULL, unit_price NUMERIC(10, 2) NOT NULL, total_price NUMERIC(10, 2) NOT NULL, order_identifier UUID NOT NULL, ticket_type_identifier UUID NOT NULL, PRIMARY KEY (identifier))');
        $this->addSql('CREATE INDEX IDX_62809DB0C4F47E3F ON order_items (order_identifier)');
        $this->addSql('CREATE INDEX IDX_62809DB068B93E5E ON order_items (ticket_type_identifier)');
        $this->addSql('CREATE TABLE payments (identifier UUID NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, provider VARCHAR(80) NOT NULL, provider_reference VARCHAR(255) DEFAULT NULL, amount NUMERIC(10, 2) NOT NULL, currency VARCHAR(3) NOT NULL, status VARCHAR(255) NOT NULL, paid_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, refused_reason TEXT DEFAULT NULL, payload JSON DEFAULT NULL, order_identifier UUID NOT NULL, PRIMARY KEY (identifier))');
        $this->addSql('CREATE INDEX IDX_65D29B32C4F47E3F ON payments (order_identifier)');
        $this->addSql('CREATE TABLE tickets (identifier UUID NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, code VARCHAR(120) NOT NULL, qrcode TEXT DEFAULT NULL, status VARCHAR(255) NOT NULL, issued_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, used_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, canceled_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, order_identifier UUID NOT NULL, order_item_identifier UUID NOT NULL, event_identifier UUID NOT NULL, ticket_type_identifier UUID NOT NULL, user_identifier UUID NOT NULL, PRIMARY KEY (identifier))');
        $this->addSql('CREATE INDEX IDX_54469DF4C4F47E3F ON tickets (order_identifier)');
        $this->addSql('CREATE INDEX IDX_54469DF4196683C ON tickets (order_item_identifier)');
        $this->addSql('CREATE INDEX IDX_54469DF42FC05A45 ON tickets (event_identifier)');
        $this->addSql('CREATE INDEX IDX_54469DF468B93E5E ON tickets (ticket_type_identifier)');
        $this->addSql('CREATE INDEX IDX_54469DF4D0494586 ON tickets (user_identifier)');
        $this->addSql('CREATE TABLE webhook_events (identifier UUID NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, type VARCHAR(120) NOT NULL, payload JSON NOT NULL, status VARCHAR(255) NOT NULL, processed_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, retries INT NOT NULL, PRIMARY KEY (identifier))');
        $this->addSql('ALTER TABLE audit_logs ADD CONSTRAINT fk_audit_log_user_identifier FOREIGN KEY (user_identifier) REFERENCES users (identifier) NOT DEFERRABLE');
        $this->addSql('ALTER TABLE check_ins ADD CONSTRAINT fk_check_in_ticket_identifier FOREIGN KEY (ticket_identifier) REFERENCES tickets (identifier) NOT DEFERRABLE');
        $this->addSql('ALTER TABLE check_ins ADD CONSTRAINT fk_check_in_checked_by_identifier FOREIGN KEY (checked_by_identifier) REFERENCES users (identifier) NOT DEFERRABLE');
        $this->addSql('ALTER TABLE coupons ADD CONSTRAINT fk_coupon_event_identifier FOREIGN KEY (event_identifier) REFERENCES events (identifier) NOT DEFERRABLE');
        $this->addSql('ALTER TABLE order_items ADD CONSTRAINT fk_order_item_order_identifier FOREIGN KEY (order_identifier) REFERENCES orders (identifier) NOT DEFERRABLE');
        $this->addSql('ALTER TABLE order_items ADD CONSTRAINT fk_order_item_ticket_type_identifier FOREIGN KEY (ticket_type_identifier) REFERENCES ticket_types (identifier) NOT DEFERRABLE');
        $this->addSql('ALTER TABLE payments ADD CONSTRAINT fk_payment_order_identifier FOREIGN KEY (order_identifier) REFERENCES orders (identifier) NOT DEFERRABLE');
        $this->addSql('ALTER TABLE tickets ADD CONSTRAINT fk_ticket_order_identifier FOREIGN KEY (order_identifier) REFERENCES orders (identifier) NOT DEFERRABLE');
        $this->addSql('ALTER TABLE tickets ADD CONSTRAINT fk_ticket_order_item_identifier FOREIGN KEY (order_item_identifier) REFERENCES order_items (identifier) NOT DEFERRABLE');
        $this->addSql('ALTER TABLE tickets ADD CONSTRAINT fk_ticket_event_identifier FOREIGN KEY (event_identifier) REFERENCES events (identifier) NOT DEFERRABLE');
        $this->addSql('ALTER TABLE tickets ADD CONSTRAINT fk_ticket_ticket_type_identifier FOREIGN KEY (ticket_type_identifier) REFERENCES ticket_types (identifier) NOT DEFERRABLE');
        $this->addSql('ALTER TABLE tickets ADD CONSTRAINT fk_ticket_user_identifier FOREIGN KEY (user_identifier) REFERENCES users (identifier) NOT DEFERRABLE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE audit_logs DROP CONSTRAINT fk_audit_log_user_identifier');
        $this->addSql('ALTER TABLE check_ins DROP CONSTRAINT fk_check_in_ticket_identifier');
        $this->addSql('ALTER TABLE check_ins DROP CONSTRAINT fk_check_in_checked_by_identifier');
        $this->addSql('ALTER TABLE coupons DROP CONSTRAINT fk_coupon_event_identifier');
        $this->addSql('ALTER TABLE order_items DROP CONSTRAINT fk_order_item_order_identifier');
        $this->addSql('ALTER TABLE order_items DROP CONSTRAINT fk_order_item_ticket_type_identifier');
        $this->addSql('ALTER TABLE payments DROP CONSTRAINT fk_payment_order_identifier');
        $this->addSql('ALTER TABLE tickets DROP CONSTRAINT fk_ticket_order_identifier');
        $this->addSql('ALTER TABLE tickets DROP CONSTRAINT fk_ticket_order_item_identifier');
        $this->addSql('ALTER TABLE tickets DROP CONSTRAINT fk_ticket_event_identifier');
        $this->addSql('ALTER TABLE tickets DROP CONSTRAINT fk_ticket_ticket_type_identifier');
        $this->addSql('ALTER TABLE tickets DROP CONSTRAINT fk_ticket_user_identifier');
        $this->addSql('DROP TABLE audit_logs');
        $this->addSql('DROP TABLE check_ins');
        $this->addSql('DROP TABLE coupons');
        $this->addSql('DROP TABLE order_items');
        $this->addSql('DROP TABLE payments');
        $this->addSql('DROP TABLE tickets');
        $this->addSql('DROP TABLE webhook_events');
    }
}
