<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180424074624 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE car (id INT AUTO_INCREMENT NOT NULL, make VARCHAR(200) NOT NULL, model VARCHAR(200) NOT NULL, type INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(200) NOT NULL, gender INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE driver (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, license VARCHAR(20) NOT NULL, age INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE carDriver (driver_id INT NOT NULL, car_id INT NOT NULL, INDEX IDX_435910A4C3423909 (driver_id), INDEX IDX_435910A4C3C6F69F (car_id), PRIMARY KEY(driver_id, car_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE trip (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, car_id INT DEFAULT NULL, driver_id INT DEFAULT NULL, length INT NOT NULL, duration INT NOT NULL, cost INT NOT NULL, INDEX IDX_7656F53B19EB6921 (client_id), INDEX IDX_7656F53BC3C6F69F (car_id), INDEX IDX_7656F53BC3423909 (driver_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json_array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE carDriver ADD CONSTRAINT FK_435910A4C3423909 FOREIGN KEY (driver_id) REFERENCES driver (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE carDriver ADD CONSTRAINT FK_435910A4C3C6F69F FOREIGN KEY (car_id) REFERENCES car (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE trip ADD CONSTRAINT FK_7656F53B19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE trip ADD CONSTRAINT FK_7656F53BC3C6F69F FOREIGN KEY (car_id) REFERENCES car (id)');
        $this->addSql('ALTER TABLE trip ADD CONSTRAINT FK_7656F53BC3423909 FOREIGN KEY (driver_id) REFERENCES driver (id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE carDriver DROP FOREIGN KEY FK_435910A4C3C6F69F');
        $this->addSql('ALTER TABLE trip DROP FOREIGN KEY FK_7656F53BC3C6F69F');
        $this->addSql('ALTER TABLE trip DROP FOREIGN KEY FK_7656F53B19EB6921');
        $this->addSql('ALTER TABLE carDriver DROP FOREIGN KEY FK_435910A4C3423909');
        $this->addSql('ALTER TABLE trip DROP FOREIGN KEY FK_7656F53BC3423909');
        $this->addSql('DROP TABLE car');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE driver');
        $this->addSql('DROP TABLE carDriver');
        $this->addSql('DROP TABLE trip');
        $this->addSql('DROP TABLE users');
    }
}
