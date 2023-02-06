<?php

    class Editeur{
        private int $id;
        private string $nom;
        
        public function __construct(string $nom){
            $this->nom = $nom;
            $this->id = 0;
        }
        
        public function getId(): int{
            return $this->id;
        }
        public function setId($id): void{
            $this->id = $id;
        }
        public function getNom(): string{
            return $this->nom;
        }
        public function setNom($nom): void{
            $this->nom = $nom;
        }
    }