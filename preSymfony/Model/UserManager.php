<?php
    class UserManager {
        private $db;

        public function __construct( $db1 ) {
            $this->db = $db1;
        }

        public function create(User $user){
            $req = $this->db->prepare('INSERT INTO users ( email, password, firstName, lastName, adress, postalCode, city, admin )
                                    VALUES ( :email, :password, :firstName, :lastName, :adress, :postalCode, :city, 0 )');
            $req->execute(array('email' => $user->getEmail(),
                'password' => $user->getPassword(),
                'firstName' => $user->getFirstName(),
                'lastName' => $user->getLastName(),
                'adress' => $user->getAddress(),
                'postalCode' => $user->getPostalCode(),
                'city' => $user->getCity(),
                 ) );
            
        }
        
        public function findAll() {
            $req = $this->db->prepare('SELECT *FROM users');
            $req->execute();
            return $req->fetchAll();
        }

        public function login($email, $password){
            $req = $this->db->prepare('SELECT * 
                            FROM users 
                            WHERE email = :email AND password = :password');
            $req->execute(array("email"=>$email,"password"=>$password));
            return $req->fetch();
        }

        public function update(User $user){
            /*$req = $this->db->prepare('UPDATE users
                        SET lastName=:lastName, firstName=:firstName, email=:email, address=:address, postalCode=:cp, city=:city, password=:password
                        WHERE ');*/
        }

        public function delete(User $user){

        }

        public function findOne($id){
            $req = $this->db->prepare('SELECT * 
            FROM users 
            WHERE id = :id');
            $req->execute(array("id"=>$id));
            return $req->fecth();
        }

        public function findByEmail($email){
            $req = $this->db->prepare('SELECT * 
            FROM users 
            WHERE email = :email');
            $req->execute(array("email"=>$email));
            return $req->fecth();
        }
    }
?>