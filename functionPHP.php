<?php

require_once 'ContactFrm/contactB.php';
session_start();

class functionPHP extends Controller {
    
    private $data = [
        'a1' => [
            'password' => 'aa',
            'nome' => '',
            'cognome' => ''
        ],
        'a2' => [
            'password' => 'bb',
            'nome' => '',
            'cognome' => ''
        ],
        'a3' => [
            'password' => 'cc',
            'nome' => '',
            'cognome' => ''
        ]
    ];
    
    public function login(string $username, string $password) : bool {
        if (!isset($this->data[$username]) || $this->data[$username]['password'] !== $password) {
            return false;
        }
        
        $_SESSION['logged'] = true;
        
        return true;
    }
    
    public function logout() {
        unset($_SESSION['logged']);
    }
        
}

new functionPHP($_POST['function']);
