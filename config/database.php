<?php
class Database {
    private $users_file = 'data/utilisateurs.json';
    
    public function __construct() {
        // S'assurer que le dossier data existe
        if (!is_dir('data')) {
            mkdir('data', 0755, true);
        }
        // S'assurer que le fichier existe
        if (!file_exists($this->users_file)) {
            $this->initDatabase();
        }
    }
    
    public function getUsers() {
        if (!file_exists($this->users_file)) {
            $this->initDatabase();
        }
        $data = file_get_contents($this->users_file);
        return json_decode($data, true) ?? ['utilisateurs' => []];
    }
    
    public function saveUser($user_data) {
        $users = $this->getUsers();
        // Vérifier si c'est un nouvel utilisateur ou une mise à jour
        $user_index = null;
        foreach ($users['utilisateurs'] as $index => $user) {
            if ($user['email'] === $user_data['email']) {
                $user_index = $index;
                break;
            }
        }
        
        if ($user_index !== null) {
            // Mise à jour
            $users['utilisateurs'][$user_index] = $user_data;
        } else {
            // Nouvel utilisateur
            $users['utilisateurs'][] = $user_data;
        }
        
        return file_put_contents($this->users_file, json_encode($users, JSON_PRETTY_PRINT));
    }
    
    public function findUserByEmail($email) {
        $users = $this->getUsers();
        if (!isset($users['utilisateurs']) || !is_array($users['utilisateurs'])) {
            return null;
        }
        
        foreach ($users['utilisateurs'] as $user) {
            if (isset($user['email']) && $user['email'] === $email) {
                return $user;
            }
        }
        return null;
    }
    
    private function initDatabase() {
        $initial_data = [
            'utilisateurs' => []
        ];
        // Créer le fichier avec un tableau vide
        file_put_contents($this->users_file, json_encode($initial_data, JSON_PRETTY_PRINT));
    }
    
    public function updateUserProgression($email, $progression_data) {
        $users = $this->getUsers();
        foreach ($users['utilisateurs'] as &$user) {
            if ($user['email'] === $email) {
                $user['progression'] = $progression_data;
                break;
            }
        }
        return file_put_contents($this->users_file, json_encode($users, JSON_PRETTY_PRINT));
    }
}
?>