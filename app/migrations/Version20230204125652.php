<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230204125652 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE airdrop (id INT AUTO_INCREMENT NOT NULL, token_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, status VARCHAR(255) NOT NULL, owner VARCHAR(36) NOT NULL, INDEX IDX_4D15AF2C41DEE7B9 (token_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE grantee (id INT AUTO_INCREMENT NOT NULL, airdrop_id INT NOT NULL, address VARCHAR(36) NOT NULL, amount INT NOT NULL, INDEX IDX_9C9615AB13543E34 (airdrop_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE token (id INT AUTO_INCREMENT NOT NULL, fa2_id INT NOT NULL, address VARCHAR(36) NOT NULL, metadata JSON NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE airdrop ADD CONSTRAINT FK_4D15AF2C41DEE7B9 FOREIGN KEY (token_id) REFERENCES token (id)');
        $this->addSql('ALTER TABLE grantee ADD CONSTRAINT FK_9C9615AB13543E34 FOREIGN KEY (airdrop_id) REFERENCES airdrop (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE airdrop DROP FOREIGN KEY FK_4D15AF2C41DEE7B9');
        $this->addSql('ALTER TABLE grantee DROP FOREIGN KEY FK_9C9615AB13543E34');
        $this->addSql('DROP TABLE airdrop');
        $this->addSql('DROP TABLE grantee');
        $this->addSql('DROP TABLE token');
    }
}
