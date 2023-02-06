<?php
    require_once 'Role.php';
    require_once 'Pal.php';
    
    class User{
        private int $id;
        private string $avatar, $pseudo, $email, $password, $role;
        
        public function __construct(string $avatar, string $pseudo, string $email, string $password, string $role){
            $this->avatar = $avatar;
            $this->pseudo = $pseudo;
            $this->email = $email;
            $this->password = $password;
            $this->role = $role;
            $this->id = 0;
        }
        
         //Avatar
        public function getAvatar(): string{
            return $this->avatar;
        }
        public function setAvatar($avatar): void{
            $this->avatar = $avatar;
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
        //Role
        public function getRole(): string{
            return $this->role;
        }
        public function setRole($role): void{
            $this->role = $role;
        }
    }