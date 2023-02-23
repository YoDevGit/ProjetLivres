<?php

    class Editeur{
        private int $id_editeur;
        private string $nom;
        
        public function __construct(string $nom = ''){
            $this->nom = $nom;
            $this->id = 0;
        }
        
        public function getId(): int{
            return $this->id;
        }
        public function setId(int $id_editeur): void{
            $this->id = $id_editeur;
        }
        public function getNom(): string{
            return $this->nom;
        }
        public function setNom(string $nom): void{
            $this->nom = $nom;
        }
    }