<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20221215103942 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Setup initial database schema';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE app_user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, registration_date DATE NOT NULL, UNIQUE INDEX UNIQ_88BDF3E9E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE booking_offer (id INT AUTO_INCREMENT NOT NULL, offer_type_id INT NOT NULL, destination_id INT NOT NULL, offer_name VARCHAR(255) NOT NULL, package_id INT NOT NULL, offer_price NUMERIC(6, 2) NOT NULL, child_price NUMERIC(6, 2) NOT NULL, description LONGTEXT NOT NULL, booking_start_date DATETIME NOT NULL, booking_end_date DATETIME NOT NULL, departure_date DATETIME NOT NULL, comeback_date DATETIME NOT NULL, departure_spot VARCHAR(255) NOT NULL, comeback_spot VARCHAR(255) NOT NULL, is_featured TINYINT(1) NOT NULL, photos_directory VARCHAR(255) NOT NULL, INDEX IDX_B8AA7A8B64444A9A (offer_type_id), INDEX IDX_B8AA7A8B816C6140 (destination_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE booking_offer_type (id INT AUTO_INCREMENT NOT NULL, type_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE career (id INT AUTO_INCREMENT NOT NULL, job_title VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, requirements VARCHAR(255) NOT NULL, salary NUMERIC(7, 2) DEFAULT NULL, recruitment_start_date DATETIME NOT NULL, recruitment_end_date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE continent (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE customers_rating (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, package INT NOT NULL, rating INT NOT NULL, comment VARCHAR(255) DEFAULT NULL, INDEX IDX_93BE1206A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE destination (id INT AUTO_INCREMENT NOT NULL, continent_id INT NOT NULL, destination_name VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, INDEX IDX_3EC63EAA921F4C77 (continent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE newsletter (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, booking_offer_id INT NOT NULL, date_of_booking DATETIME NOT NULL, adult_number INT NOT NULL, child_number INT NOT NULL, is_paid_for TINYINT(1) NOT NULL, bank_transfer_date DATETIME DEFAULT NULL, bank_transfer_title VARCHAR(255) NOT NULL, INDEX IDX_42C84955A76ED395 (user_id), INDEX IDX_42C8495568F2EA63 (booking_offer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE booking_offer ADD CONSTRAINT FK_B8AA7A8B64444A9A FOREIGN KEY (offer_type_id) REFERENCES booking_offer_type (id)');
        $this->addSql('ALTER TABLE booking_offer ADD CONSTRAINT FK_B8AA7A8B816C6140 FOREIGN KEY (destination_id) REFERENCES destination (id)');
        $this->addSql('ALTER TABLE customers_rating ADD CONSTRAINT FK_93BE1206A76ED395 FOREIGN KEY (user_id) REFERENCES app_user (id)');
        $this->addSql('ALTER TABLE destination ADD CONSTRAINT FK_3EC63EAA921F4C77 FOREIGN KEY (continent_id) REFERENCES continent (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955A76ED395 FOREIGN KEY (user_id) REFERENCES app_user (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C8495568F2EA63 FOREIGN KEY (booking_offer_id) REFERENCES booking_offer (id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE customers_rating DROP FOREIGN KEY FK_93BE1206A76ED395');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955A76ED395');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C8495568F2EA63');
        $this->addSql('ALTER TABLE booking_offer DROP FOREIGN KEY FK_B8AA7A8B64444A9A');
        $this->addSql('ALTER TABLE destination DROP FOREIGN KEY FK_3EC63EAA921F4C77');
        $this->addSql('ALTER TABLE booking_offer DROP FOREIGN KEY FK_B8AA7A8B816C6140');
        $this->addSql('DROP TABLE app_user');
        $this->addSql('DROP TABLE booking_offer');
        $this->addSql('DROP TABLE booking_offer_type');
        $this->addSql('DROP TABLE career');
        $this->addSql('DROP TABLE continent');
        $this->addSql('DROP TABLE customers_rating');
        $this->addSql('DROP TABLE destination');
        $this->addSql('DROP TABLE newsletter');
        $this->addSql('DROP TABLE reservation');
    }
}
