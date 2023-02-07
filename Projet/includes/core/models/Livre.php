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
        private ?DateTime $dateParution;
        private ?Auteur $auteur;
        private ?Editeur $editeur;
        private ?Format $format;
        private ?Genre $genre;
        private ?Langue $langue;
        
        public function __construct(string $couverture = "", string $titre = "", ?Auteur $auteur = null, ?Editeur $editeur = null, ?Format $format = null, 
            ?Genre $genre = null, int $nbPages = 0, ?DateTime $dateParution = null, ?Langue $langue = null, int $prix = 0, string $resume = "", string $avis = ""){
            $this->titre = $titre;
            $this->couverture = $couverture;
            $this->auteur = $auteur;
            $this->editeur = $editeur;
            $this->nbPages = $nbPages;
            $this->genre = $genre;
            $this->format = $format;
            $this->dateParution = $dateParution;
            $this->prix = $prix;
            $this->resume = $resume;
            $this->avis = $avis;
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
        public function getAuteur(): ?Auteur{
            return $this->auteur;
        }
        public function setAuteur($auteur): void{
            $this->auteur = $auteur;
        }
        //Editeur
        public function getEditeur(): ?Editeur{
            return $this->editeur;
        }
        public function setEditeur($editeur): void{
            $this->editeur = $editeur;
        }
        //Genre
        public function getGenre(): ?Genre{
            return $this->genre;
        }
        public function setGenre($genre): void{
            $this->genre = $genre;
        }
        //Format
        public function getFormat(): ?Format{
            return $this->format;
        }
        public function setFormat($format): void{
            $this->format = $format;
        }
        //Nombre pages
        public function getNbPages(): int{
            return $this->nbPages;
        }
        public function setNbPages($nbPages): void{
            $this->nbPages = $nbPages;
        }
        //Date parution
        public function getDateParution(): ?DateTime{
            return $this->dateParution;
        }
        public function setDateParution($dateParution): void{
            $this->dateParution = $dateParution;
        }
        //Langue
        public function getLangue(): ?Langue{
            return $this->langue;
        }
        public function setLangue($langue): void{
            $this->langue = $langue;
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
        public function setAvis($avis):void{
            $this->avis = $avis;
        }
    }