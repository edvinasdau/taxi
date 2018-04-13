<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180413112308 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE carDriver (driver_id INT NOT NULL, car_id INT NOT NULL, INDEX IDX_435910A4C3423909 (driver_id), INDEX IDX_435910A4C3C6F69F (car_id), PRIMARY KEY(driver_id, car_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE carDriver ADD CONSTRAINT FK_435910A4C3423909 FOREIGN KEY (driver_id) REFERENCES driver (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE carDriver ADD CONSTRAINT FK_435910A4C3C6F69F FOREIGN KEY (car_id) REFERENCES car (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE trip ADD client_id INT DEFAULT NULL, ADD car_id INT DEFAULT NULL, ADD driver_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE trip ADD CONSTRAINT FK_7656F53B19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE trip ADD CONSTRAINT FK_7656F53BC3C6F69F FOREIGN KEY (car_id) REFERENCES car (id)');
        $this->addSql('ALTER TABLE trip ADD CONSTRAINT FK_7656F53BC3423909 FOREIGN KEY (driver_id) REFERENCES driver (id)');
        $this->addSql('CREATE INDEX IDX_7656F53B19EB6921 ON trip (client_id)');
        $this->addSql('CREATE INDEX IDX_7656F53BC3C6F69F ON trip (car_id)');
        $this->addSql('CREATE INDEX IDX_7656F53BC3423909 ON trip (driver_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE carDriver');
        $this->addSql('ALTER TABLE trip DROP FOREIGN KEY FK_7656F53B19EB6921');
        $this->addSql('ALTER TABLE trip DROP FOREIGN KEY FK_7656F53BC3C6F69F');
        $this->addSql('ALTER TABLE trip DROP FOREIGN KEY FK_7656F53BC3423909');
        $this->addSql('DROP INDEX IDX_7656F53B19EB6921 ON trip');
        $this->addSql('DROP INDEX IDX_7656F53BC3C6F69F ON trip');
        $this->addSql('DROP INDEX IDX_7656F53BC3423909 ON trip');
        $this->addSql('ALTER TABLE trip DROP client_id, DROP car_id, DROP driver_id');
    }
}
