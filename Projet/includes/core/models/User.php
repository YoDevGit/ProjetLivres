<?php
    require_once 'Role.php';
    require_once 'Pal.php';
    
    class User{
        private int $id;
        private string $pseudo, $email, $password, $avatar;
        
        public function __construct(string $pseudo, string $email, string $password, string $avatar){
            $this->pseudo = $pseudo;
            $this->email = $email;
            $this->password = $password;
            $this->avatar = $avatar;
            $this->id = 0;
        }
        
        //Pseudo
        public function getPseudo(): string{
            return $this->pseudo;
        }
        public function setPseudo($pseudo): void{
            $this->pseudo = $pseudo;
        }
        //Email
        public function getEmail(): string{
            return $this->email;
        }
        public function setEmail($email): void{
            $this->email = $email;
        }
        //Pasword
        public function getPassword(): string{
            return $this->password;
        }
        public function setPassword($password): void{
            $this->password = $password;
        }
        //Avatar
        public function getAvatar(): string{
            return $this->avatar;
        }
        public function setAvatar($avatar): void{
            $this->avatar = $avatar;
        }
    }