<?php

    class Langue{
        private int $id;
        private string $libelle;
        
        public function __construct(string $libelle){
            $this->libelle = $libelle;
            $this->id = 0;
        }
    }