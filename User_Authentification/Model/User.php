<?php
    class User
    {
        private  $id;
        private  $email;
        private  $password;
        private  $firstName;
        private  $lastName;
        private  $address;
        private  $postalCode;
        private  $city;

        function __construct(array $donnees)
        {
            $this->hydrate($donnees);
        }

        private function hydrate( array $donnees ){
            foreach($donnees as $key=>$value){
                $method = 'set'.ucfirst($key);
                if(method_exists($this,$method)){
                    $this->$method($value);
                }
            }
        }

        public final function setId($id1) {
            $this->id=$id1;
        }
        public final  function setEmail($email1) {
            $this->email=$email1;
        }
        public final function setPassword($password1) {
            $this->password = $password1;
        }
        public final function setFirstName($firstName1) {
            $this->firstName=$firstName1;
        }
        public final function setLastName($lastName1) {
            $this->lastName=$lastName1;
        }
        public final function setAddress($address1) {
            $this->address=$address1;
        }
        public final function setPostalCode($postalCode1) {
            $this->postalCode=$postalCode1;
        }
        public final function setCity($city1) {
            $this->city=$city1;
        }


        public final function getId() {
            return $this->id;
        }
        public final function getEmail() {
            return $this->email;
        }
        public final function getPassword() {
            return $this->password;
        }
        public final function getFirstName() {
            return $this->firstName;
        }
        public final function getLastName() {
            return $this->lastName;
        }
        public final function getAddress() {
            return $this->address;
        }
        public final function getPostalCode() {
            return $this->postalCode;
        }
        public final function getCity() {
            return $this->city;
        }
    }

?>