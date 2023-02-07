<?php

    class Langue{
        private int $id;
        private string $libelle;
        
        public function __construct(string $libelle){
            $this->libelle = $libelle;
            $this->id = 0;
        }
        public function getId(): int{
            return $this->id;
        }
        public function setId(): void{
            $this->id = $id;
        }
        public function getLibelle(): string{
            return $this->libelle;
        }
        public function setLibelle(): void{
            $this->libelle = $libelle;
        }
    }