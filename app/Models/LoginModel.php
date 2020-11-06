<?php namespace App\Models;

use CodeIgniter\Model;

class LoginModel extends Model {
    protected $table = 'user_data';

    protected $allowedFields = ['username','firstname','lastname','password'];

    public function getUser_data() {
        return $this->findAll();
    }

    public function check($username, $password) {
        $this->where('username', $username); // Kohta, mistä valitaan
        $query = $this->get();
        $row = $query->getRow();
        if ($row) { 
            if (password_verify($password, $row->password)) {
            return $row;
        }
    }
    return null; // Palautetaan null, jos käyttäjänimi tai salasana ovat väärin.
    }    
}