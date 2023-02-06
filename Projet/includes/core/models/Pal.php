<?php

    class Pal{
        private int $id;
        
        public function getId(): int{
            return $this->id;
        }
        public function setId($id): void{
            $this->id = $id;
        }
    }