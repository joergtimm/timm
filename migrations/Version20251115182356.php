<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251115182356 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE credit (id INT AUTO_INCREMENT NOT NULL, person_id INT DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', document_id VARCHAR(30) NOT NULL, billing_periode DATE DEFAULT NULL, INDEX IDX_1CC16EFE217BBB47 (person_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE credit_item (id INT AUTO_INCREMENT NOT NULL, credit_id INT DEFAULT NULL, name VARCHAR(100) DEFAULT NULL, quantity DOUBLE PRECISION DEFAULT NULL, unit VARCHAR(50) DEFAULT NULL, unit_net_price INT DEFAULT NULL, tax_rate INT DEFAULT NULL, tax_amount INT DEFAULT NULL, unit_gross_price INT DEFAULT NULL, total_net INT DEFAULT NULL, total_tax INT DEFAULT NULL, total_gross INT DEFAULT NULL, position INT DEFAULT NULL, description LONGTEXT DEFAULT NULL, INDEX IDX_18D99A23CE062FF9 (credit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE credit ADD CONSTRAINT FK_1CC16EFE217BBB47 FOREIGN KEY (person_id) REFERENCES person (id)');
        $this->addSql('ALTER TABLE credit_item ADD CONSTRAINT FK_18D99A23CE062FF9 FOREIGN KEY (credit_id) REFERENCES credit (id)');
        $this->addSql('DROP TABLE messenger_messages');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, headers LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, queue_name VARCHAR(190) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE credit DROP FOREIGN KEY FK_1CC16EFE217BBB47');
        $this->addSql('ALTER TABLE credit_item DROP FOREIGN KEY FK_18D99A23CE062FF9');
        $this->addSql('DROP TABLE credit');
        $this->addSql('DROP TABLE credit_item');
    }
}
