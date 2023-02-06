<?php
    require_once 'Auteur.php';
    require_once 'Editeur.php';
    require_once 'Genre.php';
    require_once 'Saga.php';
    require_once 'Format.php';
    require_once 'Langue.php';
    require_once 'Pal.php';

    class Livre{
        private int $id, $nbPages, $prix;
        private string $titre, $couverture, $resume, $numIsbn, $avis;
        private DateTime $dateParution;
        private Auteur $auteur;
        private Editeur $editeur;
        
        public function __construct(string $titre = "", string $couverture = "", ?Auteur $auteur = null, ?Editeur $editeur = null, 
            int $nbPages = null, ?DateTime $dateParution = null, int $prix = null, string $resume = "", string $avis = ""){
            $this->titre = $titre;
            $this->auteur = $auteur;
            $this->editeur = $editeur;
            $this->id = 0;
        }
        
        //id
        public function getId(): int{
            return $this->id;
        }
        public function setId($id): void{
            $this->id = $id;
        }
        //Titre
        public function getTitre(): string{
            return $this->titre;
        }
        public function setTitre($titre): void{
            $this->titre = $titre;
        }
        //Couverture
        public function getCouverture(): string{
            return $this->couverture;
        }
        public function setCouverture($couverture): void{
            $this->couverture = $couverture;
        }
        //Auteur
        public function getAuteur(): Auteur{
            return $this->auteur;
        }
        public function setAuteur($auteur): void{
            $this->auteur = $auteur;
        }
        //Editeur
        public function getEditeur(): Editeur{
            return $this->editeur;
        }
        public function setEditeur($editeur): void{
            $this->editeur = $editeur;
        }
        //Nombre pages
        public function getNbPages(): int{
            return $this->nbPages;
        }
        public function setNbPages($nbPages): void{
            $this->nbPages = $nbPages;
        }
        //Date parution
        public function getDateParution(): DateTime{
            return $this->dateParution;
        }
        public function setDateParution($dateParution): void{
            $this->dateParution = $dateParution;
        }
        //Prix
        public function getPrix(): int{
            return $this->prix;
        }
        public function setPrix($prix): void{
            $this->prix = $prix;
        }
        //Resume
        public function getResume(): string{
            return $this->resume;
        }
        public function setResume($resume): void{
            $this->resume = $resume;
        }
        //Avis
        public function getAvis(): string{
            return $this->avis;
        }
        public function setAvis($avis): string{
            $this->avis = $avis;
        }
    }