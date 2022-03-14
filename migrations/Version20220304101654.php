<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220304101654 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE media DROP FOREIGN KEY FK_6A2CA10C71179CD6');
        $this->addSql('DROP INDEX IDX_6A2CA10C71179CD6 ON media');
        $this->addSql('ALTER TABLE media CHANGE name_id num_product_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10CCA9326D1 FOREIGN KEY (num_product_id) REFERENCES product (id)');
        $this->addSql('CREATE INDEX IDX_6A2CA10CCA9326D1 ON media (num_product_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE media DROP FOREIGN KEY FK_6A2CA10CCA9326D1');
        $this->addSql('DROP INDEX IDX_6A2CA10CCA9326D1 ON media');
        $this->addSql('ALTER TABLE media CHANGE num_product_id name_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10C71179CD6 FOREIGN KEY (name_id) REFERENCES product (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_6A2CA10C71179CD6 ON media (name_id)');
    }
}
