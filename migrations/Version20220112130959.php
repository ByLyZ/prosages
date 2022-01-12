<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220112130959 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE stages_formations (stages_id INT NOT NULL, formations_id INT NOT NULL, INDEX IDX_EF177ADC8E55E70A (stages_id), INDEX IDX_EF177ADC3BF5B0C2 (formations_id), PRIMARY KEY(stages_id, formations_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE stages_formations ADD CONSTRAINT FK_EF177ADC8E55E70A FOREIGN KEY (stages_id) REFERENCES stages (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE stages_formations ADD CONSTRAINT FK_EF177ADC3BF5B0C2 FOREIGN KEY (formations_id) REFERENCES formations (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE stages ADD entreprise_id INT NOT NULL');
        $this->addSql('ALTER TABLE stages ADD CONSTRAINT FK_2FA26A64A4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprises (id)');
        $this->addSql('CREATE INDEX IDX_2FA26A64A4AEAFEA ON stages (entreprise_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE stages_formations');
        $this->addSql('ALTER TABLE stages DROP FOREIGN KEY FK_2FA26A64A4AEAFEA');
        $this->addSql('DROP INDEX IDX_2FA26A64A4AEAFEA ON stages');
        $this->addSql('ALTER TABLE stages DROP entreprise_id');
    }
}
