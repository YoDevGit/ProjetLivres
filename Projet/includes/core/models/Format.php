<?php

 class Format{
    private int $id_format;
    private string $libelle;
     
    public function __construct(string $libelle =''){
        $this->libelle = $libelle;
        $this->id = 0;
    }
     
    public function getId(): int{
        return $this->id;
    }
    public function setId(int $id_format): void{
        $this->id = $id_format;
    }
    public function getLibelle(): string{
        return $this->libelle;
    }
    public function setLibelle(string $libelle): void{
        $this->libelle = $libelle;
    }
 }