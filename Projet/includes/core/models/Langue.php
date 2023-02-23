<?php

    class Langue{
        private int $id_langue;
        private string $libelle;
        
        public function __construct(string $libelle = ''){
            $this->libelle = $libelle;
            $this->id = 0;
        }
        public function getId(): int{
            return $this->id;
        }
        public function setId(int $id_langue): void{
            $this->id = $id_langue;
        }
        public function getLibelle(): string{
            return $this->libelle;
        }
        public function setLibelle(string $libelle): void{
            $this->libelle = $libelle;
        }
    }