<?php
    require_once 'Auteur.php';
    require_once 'Editeur.php';
    require_once 'Genre.php';
    require_once 'Saga.php';
    require_once 'Format.php';
    require_once 'Langue.php';
    require_once 'Pal.php';

    class Livre{
        private int $id_livre, $nbPages, $prix, $numIsbn;
        private string $titre, $couverture, $resume, $avis;
        private ?DateTime $dateParution;
        private ?Editeur $editeur;
        private ?Format $format;
        private ?Genre $genre;
        private ?Langue $langue;
        
        public function __construct(string $couverture = "", string $titre = "", ?Editeur $editeur = null, ?Format $format = null, 
            ?Genre $genre = null, int $nbPages = 0, ?DateTime $dateParution = null, ?Langue $langue = null, int $prix = 0, int $numIsbn = 0, string $resume = "", string $avis = ""){
            $this->titre = $titre;
            $this->couverture = $couverture;
            $this->editeur = $editeur ?? new Editeur();
            $this->nbPages = $nbPages;
            $this->genre = $genre ?? new Genre();
            $this->format = $format ?? new Format();
            $this->dateParution = $dateParution ?? new DateTime('now');
            $this->langue = $langue ?? new Langue();
            $this->prix = $prix;
            $this->numIsbn = $numIsbn;
            $this->resume = $resume;
            $this->avis = $avis;
            $this->id = 0;
        }
        
        //id
        public function getId(): int{
            return $this->id;
        }
        public function setId(int $id_livre): void{
            $this->id = $id_livre;
        }
        //Titre
        public function getTitre(): string{
            return $this->titre;
        }
        public function setTitre(string $titre): void{
            $this->titre = $titre;
        }
        //Couverture
        public function getCouverture(): string{
            return $this->couverture;
        }
        public function setCouverture(string $couverture): void{
            $this->couverture = $couverture;
        }
        //Auteur
        // public function getAuteur(): ?Auteur{
        //     return $this->auteur;
        // }
        // public function setAuteur($auteur): void{
        //     $this->auteur = $auteur;
        // }
        //Editeur
        public function getEditeur(): ?Editeur{
            return $this->editeur;
        }
        public function setEditeur(Editeur $editeur): void{
            $this->editeur = $editeur;
        }
        //Genre
        public function getGenre(): ?Genre{
            return $this->genre;
        }
        public function setGenre(Genre $genre): void{
            $this->genre = $genre;
        }
        //Format
        public function getFormat(): ?Format{
            return $this->format;
        }
        public function setFormat(Format $format): void{
            $this->format = $format;
        }
        //Nombre pages
        public function getNbPages(): int{
            return $this->nbPages;
        }
        public function setNbPages(int $nbPages): void{
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
        public function setLangue(Langue $langue): void{
            $this->langue = $langue;
        }
        //Prix
        public function getPrix(): int{
            return $this->prix;
        }
        public function setPrix(int $prix): void{
            $this->prix = $prix;
        }
        // Num Isbn
        public function getNumIsbn(): int{
            return $this->numIsbn;
        }
        public function setNumIsbn(int $numIsbn){
            $this->numIsbn = $numIsbn;
        }
        //Resume
        public function getResume(): string{
            return $this->resume;
        }
        public function setResume(string $resume): void{
            $this->resume = $resume;
        }
        //Avis
        public function getAvis(): string{
            return $this->avis;
        }
        public function setAvis(string $avis):void{
            $this->avis = $avis;
        }
    }