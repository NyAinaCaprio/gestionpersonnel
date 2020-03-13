<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200311091155 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE affectation_successive (id INT AUTO_INCREMENT NOT NULL, personnel_id INT DEFAULT NULL, lieuaffect VARCHAR(255) DEFAULT NULL, fonctiontenue VARCHAR(255) DEFAULT NULL, dateeffet DATETIME DEFAULT NULL, INDEX IDX_693A3C891C109075 (personnel_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE auto_absence (id INT AUTO_INCREMENT NOT NULL, etsouservice_id INT DEFAULT NULL, personnel_id INT DEFAULT NULL, motif VARCHAR(255) NOT NULL, se_rendre_a VARCHAR(255) NOT NULL, heure_depart TIME NOT NULL, heure_arrive TIME NOT NULL, date DATE NOT NULL, INDEX IDX_5C1FADF389F218C3 (etsouservice_id), INDEX IDX_5C1FADF31C109075 (personnel_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE avancement (id INT AUTO_INCREMENT NOT NULL, personnel_id INT DEFAULT NULL, statu VARCHAR(255) NOT NULL, reference VARCHAR(255) NOT NULL, dateeffet DATETIME NOT NULL, INDEX IDX_6D2A7A2A1C109075 (personnel_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, categorie VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE conge (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE decoration (id INT AUTO_INCREMENT NOT NULL, listedeco_id INT DEFAULT NULL, personnel_id INT DEFAULT NULL, decretouarrete VARCHAR(255) NOT NULL, annee INT NOT NULL, INDEX IDX_7649DA756394D33 (listedeco_id), INDEX IDX_7649DA71C109075 (personnel_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE detache (id INT AUTO_INCREMENT NOT NULL, detache VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE detachement (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE direction (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ecole (id INT AUTO_INCREMENT NOT NULL, personnel_id INT DEFAULT NULL, intitule VARCHAR(255) NOT NULL, etablissement VARCHAR(255) NOT NULL, diplome VARCHAR(255) NOT NULL, annee INT NOT NULL, INDEX IDX_9786AAC1C109075 (personnel_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE enfant (id INT AUTO_INCREMENT NOT NULL, personnel_id INT DEFAULT NULL, nomprenom VARCHAR(255) NOT NULL, datenaisse DATETIME NOT NULL, sexe VARCHAR(255) NOT NULL, observation VARCHAR(255) NOT NULL, INDEX IDX_34B70CA21C109075 (personnel_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etsou_service (id INT AUTO_INCREMENT NOT NULL, etsouservice VARCHAR(255) NOT NULL, obs VARCHAR(255) NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE liste_deco (id INT AUTO_INCREMENT NOT NULL, decoration VARCHAR(50) NOT NULL, libelle VARCHAR(100) NOT NULL, age INT NOT NULL, anneeservice INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personnel (id INT AUTO_INCREMENT NOT NULL, etsouservice_id INT DEFAULT NULL, categorie_id INT NOT NULL, detachement_id INT DEFAULT NULL, direction_id INT DEFAULT NULL, nomprenom VARCHAR(255) NOT NULL, sexe VARCHAR(20) NOT NULL, cin VARCHAR(12) NOT NULL, delivrele DATETIME NOT NULL, a VARCHAR(50) NOT NULL, adresseactuelle VARCHAR(255) NOT NULL, adresse_mail VARCHAR(200) DEFAULT NULL, situationmatrimoniale VARCHAR(255) NOT NULL, groupesanguin VARCHAR(10) DEFAULT NULL, groupeethnique VARCHAR(50) DEFAULT NULL, religion VARCHAR(200) DEFAULT NULL, telephone VARCHAR(10) DEFAULT NULL, filename VARCHAR(255) DEFAULT NULL, updated_at DATETIME NOT NULL, rupture VARCHAR(50) NOT NULL, lieu VARCHAR(255) NOT NULL, datenaisse DATE NOT NULL, date_retraite DATE NOT NULL, affectionactuelle VARCHAR(50) NOT NULL, matricule INT DEFAULT NULL, fonction VARCHAR(100) NOT NULL, daterecrute DATE NOT NULL, indice VARCHAR(7) NOT NULL, interruptiondu DATE DEFAULT NULL, au DATE DEFAULT NULL, sortantecole VARCHAR(50) DEFAULT NULL, nomconjoint VARCHAR(255) DEFAULT NULL, datemariage DATE DEFAULT NULL, date_naiss_conj DATE DEFAULT NULL, lieu_naiss_conj VARCHAR(100) DEFAULT NULL, bureautique TINYINT(1) DEFAULT NULL, autres LONGTEXT DEFAULT NULL, francais VARCHAR(20) NOT NULL, anglais VARCHAR(20) NOT NULL, autres_langue LONGTEXT DEFAULT NULL, num_permis VARCHAR(50) DEFAULT NULL, permis_delivrele DATE DEFAULT NULL, lieu_delivrance VARCHAR(100) DEFAULT NULL, permis_categorie VARCHAR(50) DEFAULT NULL, autres_permis LONGTEXT DEFAULT NULL, INDEX IDX_A6BCF3DE89F218C3 (etsouservice_id), INDEX IDX_A6BCF3DEBCF5E72D (categorie_id), INDEX IDX_A6BCF3DE4D6780D2 (detachement_id), INDEX IDX_A6BCF3DEAF73D997 (direction_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE search (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE affectation_successive ADD CONSTRAINT FK_693A3C891C109075 FOREIGN KEY (personnel_id) REFERENCES personnel (id)');
        $this->addSql('ALTER TABLE auto_absence ADD CONSTRAINT FK_5C1FADF389F218C3 FOREIGN KEY (etsouservice_id) REFERENCES etsou_service (id)');
        $this->addSql('ALTER TABLE auto_absence ADD CONSTRAINT FK_5C1FADF31C109075 FOREIGN KEY (personnel_id) REFERENCES personnel (id)');
        $this->addSql('ALTER TABLE avancement ADD CONSTRAINT FK_6D2A7A2A1C109075 FOREIGN KEY (personnel_id) REFERENCES personnel (id)');
        $this->addSql('ALTER TABLE decoration ADD CONSTRAINT FK_7649DA756394D33 FOREIGN KEY (listedeco_id) REFERENCES liste_deco (id)');
        $this->addSql('ALTER TABLE decoration ADD CONSTRAINT FK_7649DA71C109075 FOREIGN KEY (personnel_id) REFERENCES personnel (id)');
        $this->addSql('ALTER TABLE ecole ADD CONSTRAINT FK_9786AAC1C109075 FOREIGN KEY (personnel_id) REFERENCES personnel (id)');
        $this->addSql('ALTER TABLE enfant ADD CONSTRAINT FK_34B70CA21C109075 FOREIGN KEY (personnel_id) REFERENCES personnel (id)');
        $this->addSql('ALTER TABLE personnel ADD CONSTRAINT FK_A6BCF3DE89F218C3 FOREIGN KEY (etsouservice_id) REFERENCES etsou_service (id)');
        $this->addSql('ALTER TABLE personnel ADD CONSTRAINT FK_A6BCF3DEBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE personnel ADD CONSTRAINT FK_A6BCF3DE4D6780D2 FOREIGN KEY (detachement_id) REFERENCES detachement (id)');
        $this->addSql('ALTER TABLE personnel ADD CONSTRAINT FK_A6BCF3DEAF73D997 FOREIGN KEY (direction_id) REFERENCES direction (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE personnel DROP FOREIGN KEY FK_A6BCF3DEBCF5E72D');
        $this->addSql('ALTER TABLE personnel DROP FOREIGN KEY FK_A6BCF3DE4D6780D2');
        $this->addSql('ALTER TABLE personnel DROP FOREIGN KEY FK_A6BCF3DEAF73D997');
        $this->addSql('ALTER TABLE auto_absence DROP FOREIGN KEY FK_5C1FADF389F218C3');
        $this->addSql('ALTER TABLE personnel DROP FOREIGN KEY FK_A6BCF3DE89F218C3');
        $this->addSql('ALTER TABLE decoration DROP FOREIGN KEY FK_7649DA756394D33');
        $this->addSql('ALTER TABLE affectation_successive DROP FOREIGN KEY FK_693A3C891C109075');
        $this->addSql('ALTER TABLE auto_absence DROP FOREIGN KEY FK_5C1FADF31C109075');
        $this->addSql('ALTER TABLE avancement DROP FOREIGN KEY FK_6D2A7A2A1C109075');
        $this->addSql('ALTER TABLE decoration DROP FOREIGN KEY FK_7649DA71C109075');
        $this->addSql('ALTER TABLE ecole DROP FOREIGN KEY FK_9786AAC1C109075');
        $this->addSql('ALTER TABLE enfant DROP FOREIGN KEY FK_34B70CA21C109075');
        $this->addSql('DROP TABLE affectation_successive');
        $this->addSql('DROP TABLE auto_absence');
        $this->addSql('DROP TABLE avancement');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE conge');
        $this->addSql('DROP TABLE decoration');
        $this->addSql('DROP TABLE detache');
        $this->addSql('DROP TABLE detachement');
        $this->addSql('DROP TABLE direction');
        $this->addSql('DROP TABLE ecole');
        $this->addSql('DROP TABLE enfant');
        $this->addSql('DROP TABLE etsou_service');
        $this->addSql('DROP TABLE liste_deco');
        $this->addSql('DROP TABLE personnel');
        $this->addSql('DROP TABLE search');
        $this->addSql('DROP TABLE service');
    }
}
