<?php
    class Database {
        private $users_file = 'data/utilisateur.Json';

        public function getUsers () {
            if (!file_exists($this -> users_file)) {
                $this -> initDatabase ();
            }
            return json_decode(file_get_contents($this -> users_file), true);
        }

        public function saveUser ($user_data) {
            $users = $this -> getUsers();
            $users ['utilisateurs'][] = $user_data;
            return file_put_contents($this -> users_file, json_encode($users, JSON_PRETTY_PRINT));
        }

        public function findUserEmail ($email) {
            $users = $this -> getUsers();
            foreach ($users['utilisateurs'] as $user) {
                if ($user ['email'] === $email) {
                    return $user;
                }
            }
            return null;
        }

        private function initDatabase () {
            $initial_data = [
                'utilisateurs' => []
            ];
            file_put_contents($this -> users_file, json_encode($initial_data, JSON_PRETTY_PRINT));
        }

        public function progression ($email, $progression_data) {
            $users = $this -> getUsers();
            foreach ($users ['utilisateurs'] as $user) {
                if ($user['email'] === $email) {
                    $user['progression'] = $progression_data;
                    break;
                }
            }
            return file_put_contents($this -> users_file, json_encode($users, JSON_PRETTY_PRINT));
        }    
    }
?>