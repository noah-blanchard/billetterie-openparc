<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220209220911 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE place (id INT AUTO_INCREMENT NOT NULL, tribune VARCHAR(255) DEFAULT NULL, cat INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reserv_place (id INT AUTO_INCREMENT NOT NULL, place_id INT DEFAULT NULL, rencontre_id INT DEFAULT NULL, INDEX IDX_B7877400DA6A219 (place_id), INDEX IDX_B78774006CFC0818 (rencontre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reserv_place ADD CONSTRAINT FK_B7877400DA6A219 FOREIGN KEY (place_id) REFERENCES place (id)');
        $this->addSql('ALTER TABLE reserv_place ADD CONSTRAINT FK_B78774006CFC0818 FOREIGN KEY (rencontre_id) REFERENCES rencontre (id)');
        $this->addSql('ALTER TABLE billet DROP FOREIGN KEY FK_1F034AF66CFC0818');
        $this->addSql('DROP INDEX IDX_1F034AF66CFC0818 ON billet');
        $this->addSql('ALTER TABLE billet ADD place INT NOT NULL, ADD email VARCHAR(255) DEFAULT NULL, ADD code VARCHAR(255) DEFAULT NULL, CHANGE rencontre_id client_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE billet ADD CONSTRAINT FK_1F034AF619EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1F034AF619EB6921 ON billet (client_id)');
        $this->addSql('ALTER TABLE client ADD prenom VARCHAR(255) NOT NULL, CHANGE licence licence VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE rencontre ADD reservations INT DEFAULT NULL, ADD id_equipe_ramasseurs2 INT NOT NULL');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C8495529D76B4B');
        $this->addSql('DROP INDEX IDX_42C8495529D76B4B ON reservation');
        $this->addSql('ALTER TABLE reservation CHANGE id_joueur_id id_joueur INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reserv_place DROP FOREIGN KEY FK_B7877400DA6A219');
        $this->addSql('DROP TABLE place');
        $this->addSql('DROP TABLE reserv_place');
        $this->addSql('ALTER TABLE billet DROP FOREIGN KEY FK_1F034AF619EB6921');
        $this->addSql('DROP INDEX UNIQ_1F034AF619EB6921 ON billet');
        $this->addSql('ALTER TABLE billet DROP place, DROP email, DROP code, CHANGE client_id rencontre_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE billet ADD CONSTRAINT FK_1F034AF66CFC0818 FOREIGN KEY (rencontre_id) REFERENCES rencontre (id)');
        $this->addSql('CREATE INDEX IDX_1F034AF66CFC0818 ON billet (rencontre_id)');
        $this->addSql('ALTER TABLE client DROP prenom, CHANGE licence licence INT NOT NULL');
        $this->addSql('ALTER TABLE rencontre DROP reservations, DROP id_equipe_ramasseurs2');
        $this->addSql('ALTER TABLE reservation CHANGE id_joueur id_joueur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C8495529D76B4B FOREIGN KEY (id_joueur_id) REFERENCES joueur (id)');
        $this->addSql('CREATE INDEX IDX_42C8495529D76B4B ON reservation (id_joueur_id)');
    }
}
