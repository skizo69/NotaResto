<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200318095617 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE city (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, zipcode INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE restaurant (id INT AUTO_INCREMENT NOT NULL, relation_id INT NOT NULL, city_id INT NOT NULL, name LONGTEXT NOT NULL, description LONGTEXT DEFAULT NULL, INDEX IDX_EB95123F3256915B (relation_id), INDEX IDX_EB95123F8BAC62AF (city_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE restaurant_picture (id INT AUTO_INCREMENT NOT NULL, restaurant_id INT NOT NULL, name VARCHAR(255) NOT NULL, file VARCHAR(255) NOT NULL, INDEX IDX_DC9013FCB1E7706E (restaurant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE review (id INT AUTO_INCREMENT NOT NULL, restaurant_id INT NOT NULL, message LONGTEXT DEFAULT NULL, rating INT NOT NULL, INDEX IDX_794381C6B1E7706E (restaurant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, roles VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE restaurant ADD CONSTRAINT FK_EB95123F3256915B FOREIGN KEY (relation_id) REFERENCES city (id)');
        $this->addSql('ALTER TABLE restaurant ADD CONSTRAINT FK_EB95123F8BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
        $this->addSql('ALTER TABLE restaurant_picture ADD CONSTRAINT FK_DC9013FCB1E7706E FOREIGN KEY (restaurant_id) REFERENCES restaurant (id)');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C6B1E7706E FOREIGN KEY (restaurant_id) REFERENCES restaurant (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE restaurant DROP FOREIGN KEY FK_EB95123F3256915B');
        $this->addSql('ALTER TABLE restaurant DROP FOREIGN KEY FK_EB95123F8BAC62AF');
        $this->addSql('ALTER TABLE restaurant_picture DROP FOREIGN KEY FK_DC9013FCB1E7706E');
        $this->addSql('ALTER TABLE review DROP FOREIGN KEY FK_794381C6B1E7706E');
        $this->addSql('DROP TABLE city');
        $this->addSql('DROP TABLE restaurant');
        $this->addSql('DROP TABLE restaurant_picture');
        $this->addSql('DROP TABLE review');
        $this->addSql('DROP TABLE user');
    }
}
