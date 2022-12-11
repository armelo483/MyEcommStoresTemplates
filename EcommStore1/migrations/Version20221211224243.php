<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221211224243 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_5CECC7BEA76ED395');
        $this->addSql('CREATE TEMPORARY TABLE __temp__adress AS SELECT id, user_id, fullname, company, address, complement, phone, postal, country FROM adress');
        $this->addSql('DROP TABLE adress');
        $this->addSql('CREATE TABLE adress (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, fullname VARCHAR(255) NOT NULL COLLATE BINARY, company VARCHAR(255) DEFAULT NULL COLLATE BINARY, address VARCHAR(400) NOT NULL COLLATE BINARY, complement VARCHAR(255) DEFAULT NULL COLLATE BINARY, phone VARCHAR(255) DEFAULT NULL COLLATE BINARY, postal VARCHAR(255) NOT NULL COLLATE BINARY, country VARCHAR(255) NOT NULL COLLATE BINARY, CONSTRAINT FK_5CECC7BEA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO adress (id, user_id, fullname, company, address, complement, phone, postal, country) SELECT id, user_id, fullname, company, address, complement, phone, postal, country FROM __temp__adress');
        $this->addSql('DROP TABLE __temp__adress');
        $this->addSql('CREATE INDEX IDX_5CECC7BEA76ED395 ON adress (user_id)');
        $this->addSql('DROP INDEX IDX_3AF34668D3202E52');
        $this->addSql('CREATE TEMPORARY TABLE __temp__categories AS SELECT id, rayon_id, name, image FROM categories');
        $this->addSql('DROP TABLE categories');
        $this->addSql('CREATE TABLE categories (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, rayon_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL COLLATE BINARY, image VARCHAR(255) DEFAULT NULL COLLATE BINARY, CONSTRAINT FK_3AF34668D3202E52 FOREIGN KEY (rayon_id) REFERENCES rayon (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO categories (id, rayon_id, name, image) SELECT id, rayon_id, name, image FROM __temp__categories');
        $this->addSql('DROP TABLE __temp__categories');
        $this->addSql('CREATE INDEX IDX_3AF34668D3202E52 ON categories (rayon_id)');
        $this->addSql('DROP INDEX IDX_845CA2C14584665A');
        $this->addSql('DROP INDEX IDX_845CA2C1D6C5CDE1');
        $this->addSql('CREATE TEMPORARY TABLE __temp__order_details AS SELECT id, product_id, matching_order_id, quantity, subtotal, subtotal_ttc, tax FROM order_details');
        $this->addSql('DROP TABLE order_details');
        $this->addSql('CREATE TABLE order_details (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, product_id INTEGER NOT NULL, matching_order_id INTEGER NOT NULL, quantity INTEGER NOT NULL, subtotal DOUBLE PRECISION NOT NULL, subtotal_ttc DOUBLE PRECISION NOT NULL, tax DOUBLE PRECISION NOT NULL, CONSTRAINT FK_845CA2C14584665A FOREIGN KEY (product_id) REFERENCES product (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_845CA2C1D6C5CDE1 FOREIGN KEY (matching_order_id) REFERENCES orders (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO order_details (id, product_id, matching_order_id, quantity, subtotal, subtotal_ttc, tax) SELECT id, product_id, matching_order_id, quantity, subtotal, subtotal_ttc, tax FROM __temp__order_details');
        $this->addSql('DROP TABLE __temp__order_details');
        $this->addSql('CREATE INDEX IDX_845CA2C14584665A ON order_details (product_id)');
        $this->addSql('CREATE INDEX IDX_845CA2C1D6C5CDE1 ON order_details (matching_order_id)');
        $this->addSql('DROP INDEX IDX_E52FFDEEA76ED395');
        $this->addSql('DROP INDEX IDX_E52FFDEE21DFC797');
        $this->addSql('CREATE TEMPORARY TABLE __temp__orders AS SELECT id, user_id, carrier_id, reference, full_name, delivery_address, is_paid, more_info, created_at FROM orders');
        $this->addSql('DROP TABLE orders');
        $this->addSql('CREATE TABLE orders (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, carrier_id INTEGER NOT NULL, reference VARCHAR(255) NOT NULL COLLATE BINARY, full_name CLOB NOT NULL COLLATE BINARY, delivery_address CLOB NOT NULL COLLATE BINARY, is_paid BOOLEAN NOT NULL, more_info CLOB DEFAULT NULL COLLATE BINARY, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , CONSTRAINT FK_E52FFDEEA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_E52FFDEE21DFC797 FOREIGN KEY (carrier_id) REFERENCES carrier (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO orders (id, user_id, carrier_id, reference, full_name, delivery_address, is_paid, more_info, created_at) SELECT id, user_id, carrier_id, reference, full_name, delivery_address, is_paid, more_info, created_at FROM __temp__orders');
        $this->addSql('DROP TABLE __temp__orders');
        $this->addSql('CREATE INDEX IDX_E52FFDEEA76ED395 ON orders (user_id)');
        $this->addSql('CREATE INDEX IDX_E52FFDEE21DFC797 ON orders (carrier_id)');
        $this->addSql('DROP INDEX IDX_D34A04ADA21214B7');
        $this->addSql('CREATE TEMPORARY TABLE __temp__product AS SELECT id, categories_id, name, description, price, is_new_arrival, is_featured, is_special_offer, featured_image, is_best_seller FROM product');
        $this->addSql('DROP TABLE product');
        $this->addSql('CREATE TABLE product (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, categories_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL COLLATE BINARY, description CLOB NOT NULL COLLATE BINARY, price DOUBLE PRECISION NOT NULL, is_new_arrival BOOLEAN DEFAULT NULL, is_featured BOOLEAN DEFAULT NULL, is_special_offer BOOLEAN DEFAULT NULL, featured_image VARCHAR(255) DEFAULT NULL COLLATE BINARY, is_best_seller BOOLEAN DEFAULT NULL, brand VARCHAR(255) DEFAULT NULL, CONSTRAINT FK_D34A04ADA21214B7 FOREIGN KEY (categories_id) REFERENCES categories (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO product (id, categories_id, name, description, price, is_new_arrival, is_featured, is_special_offer, featured_image, is_best_seller) SELECT id, categories_id, name, description, price, is_new_arrival, is_featured, is_special_offer, featured_image, is_best_seller FROM __temp__product');
        $this->addSql('DROP TABLE __temp__product');
        $this->addSql('CREATE INDEX IDX_D34A04ADA21214B7 ON product (categories_id)');
        $this->addSql('DROP INDEX IDX_6970EB0FA76ED395');
        $this->addSql('DROP INDEX IDX_6970EB0F4584665A');
        $this->addSql('CREATE TEMPORARY TABLE __temp__reviews AS SELECT id, user_id, product_id, note, comment FROM reviews');
        $this->addSql('DROP TABLE reviews');
        $this->addSql('CREATE TABLE reviews (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, product_id INTEGER NOT NULL, note DOUBLE PRECISION NOT NULL, comment CLOB DEFAULT NULL COLLATE BINARY, CONSTRAINT FK_6970EB0FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_6970EB0F4584665A FOREIGN KEY (product_id) REFERENCES product (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO reviews (id, user_id, product_id, note, comment) SELECT id, user_id, product_id, note, comment FROM __temp__reviews');
        $this->addSql('DROP TABLE __temp__reviews');
        $this->addSql('CREATE INDEX IDX_6970EB0FA76ED395 ON reviews (user_id)');
        $this->addSql('CREATE INDEX IDX_6970EB0F4584665A ON reviews (product_id)');
        $this->addSql('DROP INDEX IDX_F5F6EFBC8D7B4FB4');
        $this->addSql('DROP INDEX IDX_F5F6EFBC4584665A');
        $this->addSql('CREATE TEMPORARY TABLE __temp__tags_product AS SELECT tags_id, product_id FROM tags_product');
        $this->addSql('DROP TABLE tags_product');
        $this->addSql('CREATE TABLE tags_product (tags_id INTEGER NOT NULL, product_id INTEGER NOT NULL, PRIMARY KEY(tags_id, product_id), CONSTRAINT FK_F5F6EFBC8D7B4FB4 FOREIGN KEY (tags_id) REFERENCES tags (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_F5F6EFBC4584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO tags_product (tags_id, product_id) SELECT tags_id, product_id FROM __temp__tags_product');
        $this->addSql('DROP TABLE __temp__tags_product');
        $this->addSql('CREATE INDEX IDX_F5F6EFBC8D7B4FB4 ON tags_product (tags_id)');
        $this->addSql('CREATE INDEX IDX_F5F6EFBC4584665A ON tags_product (product_id)');
        $this->addSql('DROP INDEX IDX_75EA56E0FB7336F0');
        $this->addSql('DROP INDEX IDX_75EA56E0E3BD61CE');
        $this->addSql('DROP INDEX IDX_75EA56E016BA31DB');
        $this->addSql('CREATE TEMPORARY TABLE __temp__messenger_messages AS SELECT id, body, headers, queue_name, created_at, available_at, delivered_at FROM messenger_messages');
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('CREATE TABLE messenger_messages (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, body CLOB NOT NULL COLLATE BINARY, headers CLOB NOT NULL COLLATE BINARY, queue_name VARCHAR(190) NOT NULL COLLATE BINARY, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL)');
        $this->addSql('INSERT INTO messenger_messages (id, body, headers, queue_name, created_at, available_at, delivered_at) SELECT id, body, headers, queue_name, created_at, available_at, delivered_at FROM __temp__messenger_messages');
        $this->addSql('DROP TABLE __temp__messenger_messages');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_5CECC7BEA76ED395');
        $this->addSql('CREATE TEMPORARY TABLE __temp__adress AS SELECT id, user_id, fullname, company, address, complement, phone, postal, country FROM adress');
        $this->addSql('DROP TABLE adress');
        $this->addSql('CREATE TABLE adress (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, fullname VARCHAR(255) NOT NULL, company VARCHAR(255) DEFAULT NULL, address VARCHAR(400) NOT NULL, complement VARCHAR(255) DEFAULT NULL, phone VARCHAR(255) DEFAULT NULL, postal VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO adress (id, user_id, fullname, company, address, complement, phone, postal, country) SELECT id, user_id, fullname, company, address, complement, phone, postal, country FROM __temp__adress');
        $this->addSql('DROP TABLE __temp__adress');
        $this->addSql('CREATE INDEX IDX_5CECC7BEA76ED395 ON adress (user_id)');
        $this->addSql('DROP INDEX IDX_3AF34668D3202E52');
        $this->addSql('CREATE TEMPORARY TABLE __temp__categories AS SELECT id, rayon_id, name, image FROM categories');
        $this->addSql('DROP TABLE categories');
        $this->addSql('CREATE TABLE categories (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, rayon_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, image VARCHAR(255) DEFAULT NULL)');
        $this->addSql('INSERT INTO categories (id, rayon_id, name, image) SELECT id, rayon_id, name, image FROM __temp__categories');
        $this->addSql('DROP TABLE __temp__categories');
        $this->addSql('CREATE INDEX IDX_3AF34668D3202E52 ON categories (rayon_id)');
        $this->addSql('DROP INDEX IDX_845CA2C14584665A');
        $this->addSql('DROP INDEX IDX_845CA2C1D6C5CDE1');
        $this->addSql('CREATE TEMPORARY TABLE __temp__order_details AS SELECT id, product_id, matching_order_id, quantity, subtotal, subtotal_ttc, tax FROM order_details');
        $this->addSql('DROP TABLE order_details');
        $this->addSql('CREATE TABLE order_details (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, product_id INTEGER NOT NULL, matching_order_id INTEGER NOT NULL, quantity INTEGER NOT NULL, subtotal DOUBLE PRECISION NOT NULL, subtotal_ttc DOUBLE PRECISION NOT NULL, tax DOUBLE PRECISION NOT NULL)');
        $this->addSql('INSERT INTO order_details (id, product_id, matching_order_id, quantity, subtotal, subtotal_ttc, tax) SELECT id, product_id, matching_order_id, quantity, subtotal, subtotal_ttc, tax FROM __temp__order_details');
        $this->addSql('DROP TABLE __temp__order_details');
        $this->addSql('CREATE INDEX IDX_845CA2C14584665A ON order_details (product_id)');
        $this->addSql('CREATE INDEX IDX_845CA2C1D6C5CDE1 ON order_details (matching_order_id)');
        $this->addSql('DROP INDEX IDX_E52FFDEEA76ED395');
        $this->addSql('DROP INDEX IDX_E52FFDEE21DFC797');
        $this->addSql('CREATE TEMPORARY TABLE __temp__orders AS SELECT id, user_id, carrier_id, reference, full_name, delivery_address, is_paid, more_info, created_at FROM orders');
        $this->addSql('DROP TABLE orders');
        $this->addSql('CREATE TABLE orders (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, carrier_id INTEGER NOT NULL, reference VARCHAR(255) NOT NULL, full_name CLOB NOT NULL, delivery_address CLOB NOT NULL, is_paid BOOLEAN NOT NULL, more_info CLOB DEFAULT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        )');
        $this->addSql('INSERT INTO orders (id, user_id, carrier_id, reference, full_name, delivery_address, is_paid, more_info, created_at) SELECT id, user_id, carrier_id, reference, full_name, delivery_address, is_paid, more_info, created_at FROM __temp__orders');
        $this->addSql('DROP TABLE __temp__orders');
        $this->addSql('CREATE INDEX IDX_E52FFDEEA76ED395 ON orders (user_id)');
        $this->addSql('CREATE INDEX IDX_E52FFDEE21DFC797 ON orders (carrier_id)');
        $this->addSql('DROP INDEX IDX_D34A04ADA21214B7');
        $this->addSql('CREATE TEMPORARY TABLE __temp__product AS SELECT id, categories_id, name, description, price, is_new_arrival, is_featured, is_special_offer, featured_image, is_best_seller FROM product');
        $this->addSql('DROP TABLE product');
        $this->addSql('CREATE TABLE product (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, categories_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL, description CLOB NOT NULL, price DOUBLE PRECISION NOT NULL, is_new_arrival BOOLEAN DEFAULT NULL, is_featured BOOLEAN DEFAULT NULL, is_special_offer BOOLEAN DEFAULT NULL, featured_image VARCHAR(255) DEFAULT NULL, is_best_seller BOOLEAN DEFAULT NULL)');
        $this->addSql('INSERT INTO product (id, categories_id, name, description, price, is_new_arrival, is_featured, is_special_offer, featured_image, is_best_seller) SELECT id, categories_id, name, description, price, is_new_arrival, is_featured, is_special_offer, featured_image, is_best_seller FROM __temp__product');
        $this->addSql('DROP TABLE __temp__product');
        $this->addSql('CREATE INDEX IDX_D34A04ADA21214B7 ON product (categories_id)');
        $this->addSql('DROP INDEX IDX_6970EB0FA76ED395');
        $this->addSql('DROP INDEX IDX_6970EB0F4584665A');
        $this->addSql('CREATE TEMPORARY TABLE __temp__reviews AS SELECT id, user_id, product_id, note, comment FROM reviews');
        $this->addSql('DROP TABLE reviews');
        $this->addSql('CREATE TABLE reviews (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, product_id INTEGER NOT NULL, note DOUBLE PRECISION NOT NULL, comment CLOB DEFAULT NULL)');
        $this->addSql('INSERT INTO reviews (id, user_id, product_id, note, comment) SELECT id, user_id, product_id, note, comment FROM __temp__reviews');
        $this->addSql('DROP TABLE __temp__reviews');
        $this->addSql('CREATE INDEX IDX_6970EB0FA76ED395 ON reviews (user_id)');
        $this->addSql('CREATE INDEX IDX_6970EB0F4584665A ON reviews (product_id)');
        $this->addSql('DROP INDEX IDX_F5F6EFBC8D7B4FB4');
        $this->addSql('DROP INDEX IDX_F5F6EFBC4584665A');
        $this->addSql('CREATE TEMPORARY TABLE __temp__tags_product AS SELECT tags_id, product_id FROM tags_product');
        $this->addSql('DROP TABLE tags_product');
        $this->addSql('CREATE TABLE tags_product (tags_id INTEGER NOT NULL, product_id INTEGER NOT NULL, PRIMARY KEY(tags_id, product_id))');
        $this->addSql('INSERT INTO tags_product (tags_id, product_id) SELECT tags_id, product_id FROM __temp__tags_product');
        $this->addSql('DROP TABLE __temp__tags_product');
        $this->addSql('CREATE INDEX IDX_F5F6EFBC8D7B4FB4 ON tags_product (tags_id)');
        $this->addSql('CREATE INDEX IDX_F5F6EFBC4584665A ON tags_product (product_id)');
    }
}
