<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241211101916 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_cat (user_id INT NOT NULL, cat_id INT NOT NULL, INDEX IDX_75482223A76ED395 (user_id), INDEX IDX_75482223E6ADA943 (cat_id), PRIMARY KEY(user_id, cat_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_cat ADD CONSTRAINT FK_75482223A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_cat ADD CONSTRAINT FK_75482223E6ADA943 FOREIGN KEY (cat_id) REFERENCES cat (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user ADD house_id INT NOT NULL, ADD couple_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6496BB74515 FOREIGN KEY (house_id) REFERENCES house (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649F66468CA FOREIGN KEY (couple_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_8D93D6496BB74515 ON user (house_id)');
        $this->addSql('CREATE INDEX IDX_8D93D649F66468CA ON user (couple_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_cat DROP FOREIGN KEY FK_75482223A76ED395');
        $this->addSql('ALTER TABLE user_cat DROP FOREIGN KEY FK_75482223E6ADA943');
        $this->addSql('DROP TABLE user_cat');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6496BB74515');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649F66468CA');
        $this->addSql('DROP INDEX IDX_8D93D6496BB74515 ON user');
        $this->addSql('DROP INDEX IDX_8D93D649F66468CA ON user');
        $this->addSql('ALTER TABLE user DROP house_id, DROP couple_id');
    }
}
