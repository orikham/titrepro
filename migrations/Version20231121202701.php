<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231121202701 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category_sous_category (category_id INT NOT NULL, sous_category_id INT NOT NULL, INDEX IDX_10D908DF12469DE2 (category_id), INDEX IDX_10D908DF527FEED1 (sous_category_id), PRIMARY KEY(category_id, sous_category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DELETE TABLE picture (id INT AUTO_INCREMENT NOT NULL, cat_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_16DB4F89E6ADA943 (cat_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE category_sous_category ADD CONSTRAINT FK_10D908DF12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category_sous_category ADD CONSTRAINT FK_10D908DF527FEED1 FOREIGN KEY (sous_category_id) REFERENCES sous_category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE picture ADD CONSTRAINT FK_16DB4F89E6ADA943 FOREIGN KEY (cat_id) REFERENCES category (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category_sous_category DROP FOREIGN KEY FK_10D908DF12469DE2');
        $this->addSql('ALTER TABLE category_sous_category DROP FOREIGN KEY FK_10D908DF527FEED1');
        $this->addSql('ALTER TABLE picture DROP FOREIGN KEY FK_16DB4F89E6ADA943');
        $this->addSql('DROP TABLE category_sous_category');
        $this->addSql('DROP TABLE picture');
    }
}
