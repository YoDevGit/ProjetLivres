<?php

    class Genre{
        private int $id_genre;
        private string $libelle;
        
        public function __construct(string $libelle = ''){
            $this->libelle = $libelle;
            $this->id = 0;
        }
        
        //id
        public function getId(): int{
            return $this->id;
        }
        public function setId(int $id_genre): void{
            $this->id = $id_genre;
        }
        //Libelle
        public function getLibelle(): string{
            return $this->libelle;
        }
        public function setLibelle(string $libelle): void{
            $this->libelle = $libelle;
        }
    }