<?php
    require_once 'Civilite.php';
    require_once 'Nationalite.php';

    class Auteur{
        private int $id;
        private string $nom, $prenom, $nationalite;
        
        public function __construct(string $nom = "", string $prenom = "", string $nationalite = ""){
            $this->nom = $nom;
            $this->prenom = $prenom;
            $this->nationalite = $nationalite;
            $this->id = 0;
        }
        
        public function getId(): int{
            return $this->id;
        }
        public function setId(int $id): void{
            $this->id = $id;
        }
        
        public function getNom(): string{
            return $this->nom;
        }
        public function setNom(string $nom): void{
            $this->nom = $nom;
        }
        public function getPrenom(): string{
            return $this->prenom;
        }
        public function setPrenom(string $prenom): void{
            $this->prenom = $prenom;
        }
        public function getNationalite(): string{
            return $this->nationalite;
        }
        public function setNationalite(string $nationalite): void{
            $this->nationalite = $nationalite;
        }
    }