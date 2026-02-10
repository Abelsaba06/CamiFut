<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260210074209 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE camiseta (id INT AUTO_INCREMENT NOT NULL, equipo VARCHAR(255) NOT NULL, imagen VARCHAR(255) NOT NULL, temporada VARCHAR(5) NOT NULL, precio INT NOT NULL, categoria_id INT DEFAULT NULL, INDEX IDX_70BFDD5D3397707A (categoria_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE categoria (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE camiseta ADD CONSTRAINT FK_70BFDD5D3397707A FOREIGN KEY (categoria_id) REFERENCES categoria (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE camiseta DROP FOREIGN KEY FK_70BFDD5D3397707A');
        $this->addSql('DROP TABLE camiseta');
        $this->addSql('DROP TABLE categoria');
    }
}
