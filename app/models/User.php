<?php
    class User{
        private $db;

        public function __construct(){
            $this->db = new Database();
        }

        public function register($data){
            $this->db->query('INSERT INTO users (name, email, password) VALUES (:name, :email, :password)');
            
            $this->db->bind(':name', $data['name']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':password', $data['password']);

            // Execute
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function login($email, $password){
            $this->db->query('SELECT  * FROM users WHERE email = :email');
            $this->db->bind(':email', $email);

            $row = $this->db->single();

            $hashed_password = $row->password;

            if(password_verify($password, $hashed_password)){
                return $row;
            } else {
                return false;
            }
        }

        public function updateUserProfile($data){
            $this->db->query("UPDATE users_details SET 
            specialtiesAndCourses = :specialtiesAndCourses,
            oks = :oks,
            year = :year,
            fn = :fn,
            interests = :interests
            WHERE userId = :id");

            $this->db->bind(':specialtiesAndCourses', $data['specialtiesAndCourses']);
            $this->db->bind(':oks', $data['oks']);
            $this->db->bind(':year', $data['year']);
            $this->db->bind(':fn', $data['fn']);
            $this->db->bind(':interests', $data['interests']);
            $this->db->bind(':id', $data['id']);

            if($this->db->execute()){
                return true;
            } else {
                echo "fail";
                return false;
            }
        }

        public function getUserProfileById($id){
            $this->db->query("SELECT * FROM users_details WHERE userId = :id");
            $this->db->bind(':id', $id);

            return $this->db->single();
        }

        // Find user by email
        public function findUserByEmail($email){
            $this->db->query("SELECT * FROM users WHERE email = :email");
            $this->db->bind(':email', $email);

            $row = $this->db->single();

            // Check row
            if($this->db->rowCount() > 0){
                return true;
            }else{
                return false;
            }
        }
    }
?>