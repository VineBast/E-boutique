<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220304100807 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE command_line ADD num_product_id INT NOT NULL, DROP num_product');
        $this->addSql('ALTER TABLE command_line ADD CONSTRAINT FK_70BE1A7BCA9326D1 FOREIGN KEY (num_product_id) REFERENCES product (id)');
        $this->addSql('CREATE INDEX IDX_70BE1A7BCA9326D1 ON command_line (num_product_id)');
        $this->addSql('ALTER TABLE media DROP FOREIGN KEY FK_6A2CA10C8C26A5E8');
        $this->addSql('DROP INDEX IDX_6A2CA10C8C26A5E8 ON media');
        $this->addSql('ALTER TABLE media DROP order_number_id');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADCA9326D1');
        $this->addSql('DROP INDEX IDX_D34A04ADCA9326D1 ON product');
        $this->addSql('ALTER TABLE product ADD num_product VARCHAR(40) NOT NULL, DROP num_product_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE command_line DROP FOREIGN KEY FK_70BE1A7BCA9326D1');
        $this->addSql('DROP INDEX IDX_70BE1A7BCA9326D1 ON command_line');
        $this->addSql('ALTER TABLE command_line ADD num_product VARCHAR(40) NOT NULL, DROP num_product_id');
        $this->addSql('ALTER TABLE media ADD order_number_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10C8C26A5E8 FOREIGN KEY (order_number_id) REFERENCES command_line (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_6A2CA10C8C26A5E8 ON media (order_number_id)');
        $this->addSql('ALTER TABLE product ADD num_product_id INT NOT NULL, DROP num_product');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADCA9326D1 FOREIGN KEY (num_product_id) REFERENCES command_line (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_D34A04ADCA9326D1 ON product (num_product_id)');
    }
}
