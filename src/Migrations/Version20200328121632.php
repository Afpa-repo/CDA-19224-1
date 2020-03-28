<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200328121632 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE ct404_category (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ct404commercial (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(50) NOT NULL, lastname VARCHAR(50) NOT NULL, commercial_for_individual TINYINT(1) NOT NULL, commercial_for_professional TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ct404particular (id INT AUTO_INCREMENT NOT NULL, id_ct404_role_id INT DEFAULT NULL, id_ct404_commercial_id INT DEFAULT NULL, firstname VARCHAR(50) NOT NULL, lastname VARCHAR(50) NOT NULL, address VARCHAR(50) NOT NULL, zip_code VARCHAR(5) NOT NULL, city VARCHAR(50) NOT NULL, mail VARCHAR(50) NOT NULL, phone_number INT NOT NULL, password VARCHAR(60) NOT NULL, pseudo VARCHAR(50) NOT NULL, clef VARCHAR(100) NOT NULL, actif TINYINT(1) NOT NULL, date_registeur DATETIME NOT NULL, INDEX IDX_59A290B961DDAC3C (id_ct404_role_id), INDEX IDX_59A290B96D7E3993 (id_ct404_commercial_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ct404_role (id INT AUTO_INCREMENT NOT NULL, role_name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ct404ordered (id INT AUTO_INCREMENT NOT NULL, id_ct404_commercial_id INT DEFAULT NULL, order_date DATETIME NOT NULL, delivery_date DATE NOT NULL, total_price NUMERIC(10, 2) NOT NULL, INDEX IDX_7A3226166D7E3993 (id_ct404_commercial_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ct404_order_detail (id INT AUTO_INCREMENT NOT NULL, idorder_id INT DEFAULT NULL, id_product_id INT DEFAULT NULL, quantity VARCHAR(11) NOT NULL, INDEX IDX_ED896F46274A2535 (idorder_id), INDEX IDX_ED896F46E00EE68D (id_product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ct404supplier (id INT AUTO_INCREMENT NOT NULL, supplier_name VARCHAR(50) NOT NULL, supplier_address VARCHAR(50) NOT NULL, supplier_city VARCHAR(50) NOT NULL, supplier_zipe_code INT NOT NULL, supplier_phone VARCHAR(14) NOT NULL, supplier_mail VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ct404_product (id INT AUTO_INCREMENT NOT NULL, id_ct404_supplier_id INT DEFAULT NULL, idct404_category_id INT DEFAULT NULL, product_name VARCHAR(50) NOT NULL, description LONGTEXT NOT NULL, price NUMERIC(15, 2) NOT NULL, quantity_stock VARCHAR(11) NOT NULL, quantity_of_alerte VARCHAR(11) NOT NULL, category_name VARCHAR(255) NOT NULL, INDEX IDX_DABC5B583688741C (id_ct404_supplier_id), INDEX IDX_DABC5B58B56FCC00 (idct404_category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ct404_professional (id INT AUTO_INCREMENT NOT NULL, password_id INT DEFAULT NULL, siret_number VARCHAR(50) NOT NULL, compagny_name VARCHAR(50) NOT NULL, contact_name VARCHAR(50) NOT NULL, mail VARCHAR(50) NOT NULL, date_register DATETIME NOT NULL, clef VARCHAR(100) NOT NULL, actif TINYINT(1) NOT NULL, INDEX IDX_C08407583E4A79C1 (password_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ct404particular ADD CONSTRAINT FK_59A290B961DDAC3C FOREIGN KEY (id_ct404_role_id) REFERENCES ct404_role (id)');
        $this->addSql('ALTER TABLE ct404particular ADD CONSTRAINT FK_59A290B96D7E3993 FOREIGN KEY (id_ct404_commercial_id) REFERENCES ct404commercial (id)');
        $this->addSql('ALTER TABLE ct404ordered ADD CONSTRAINT FK_7A3226166D7E3993 FOREIGN KEY (id_ct404_commercial_id) REFERENCES ct404commercial (id)');
        $this->addSql('ALTER TABLE ct404_order_detail ADD CONSTRAINT FK_9EB81BB4274A2535 FOREIGN KEY (idorder_id) REFERENCES ct404ordered (id)');
        $this->addSql('ALTER TABLE ct404_order_detail ADD CONSTRAINT FK_9EB81BB4E00EE68D FOREIGN KEY (id_product_id) REFERENCES ct404_product (id)');
        $this->addSql('ALTER TABLE ct404_product ADD CONSTRAINT FK_DABC5B583688741C FOREIGN KEY (id_ct404_supplier_id) REFERENCES ct404supplier (id)');
        $this->addSql('ALTER TABLE ct404_product ADD CONSTRAINT FK_DABC5B58B56FCC00 FOREIGN KEY (idct404_category_id) REFERENCES ct404_category (id)');
        $this->addSql('ALTER TABLE ct404_professional ADD CONSTRAINT FK_C08407583E4A79C1 FOREIGN KEY (password_id) REFERENCES ct404commercial (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ct404_product DROP FOREIGN KEY FK_DABC5B58B56FCC00');
        $this->addSql('ALTER TABLE ct404particular DROP FOREIGN KEY FK_59A290B96D7E3993');
        $this->addSql('ALTER TABLE ct404ordered DROP FOREIGN KEY FK_7A3226166D7E3993');
        $this->addSql('ALTER TABLE ct404_professional DROP FOREIGN KEY FK_C08407583E4A79C1');
        $this->addSql('ALTER TABLE ct404particular DROP FOREIGN KEY FK_59A290B961DDAC3C');
        $this->addSql('ALTER TABLE ct404_order_detail DROP FOREIGN KEY FK_9EB81BB4274A2535');
        $this->addSql('ALTER TABLE ct404_product DROP FOREIGN KEY FK_DABC5B583688741C');
        $this->addSql('ALTER TABLE ct404_order_detail DROP FOREIGN KEY FK_9EB81BB4E00EE68D');
        $this->addSql('DROP TABLE ct404_category');
        $this->addSql('DROP TABLE ct404commercial');
        $this->addSql('DROP TABLE ct404particular');
        $this->addSql('DROP TABLE ct404_role');
        $this->addSql('DROP TABLE ct404ordered');
        $this->addSql('DROP TABLE ct404_order_detail');
        $this->addSql('DROP TABLE ct404supplier');
        $this->addSql('DROP TABLE ct404_product');
        $this->addSql('DROP TABLE ct404_professional');
    }
}
