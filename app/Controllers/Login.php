<?php namespace App\Controllers;

use App\Models\LoginModel;

const REGISTER_TITLE = 'To do - Register';
const LOGIN_TITLE = 'To do - Log in';

class Login extends BaseController {

    // Construct aloittaa session
    public function __construct() {
        $session = \Config\Services::session();
        $session->start();
    }

    // Avaa kirjautumisikkunan
    public function index() {
        $data['title'] = 'To do - login';
        echo view('templates/header.php', $data);
        echo view('login/login.php', $data);
        echo view('templates/footer.php', $data);
    }

    public function register() {
        $data['title'] = REGISTER_TITLE;
        echo view('templates/header.php', $data);
        echo view('login/register.php', $data);
        echo view('templates/footer.php');
    } 

    public function registration() {
        $model = new LoginModel();

        if (!$this->validate([
            // Tarkistetaan annetut tiedot
            'user' => 'required|min_length[8]|max_length[30]',
            'password' => 'required|min_length[8]|max_length[30]',
            'confirmpassword' => 'required|min_length[8]|max_length[30]|matches[password]',
        ])) {
            echo view('templates/header' , ['title' => REGISTER_TITLE]);
            echo view('login/register');
            echo view('templates/footer');
        }
        else {
            // Tallennetaan tiedot tietokantaan
            $model->save([
                'username' => $this->request->getVar('user'),
                'password' => password_hash($this->request->getVar('password'),PASSWORD_DEFAULT),
                'firstname' => $this->request->getVar('fname'),
                'lastname' => $this->request->getVar('lname')
            ]);
            return redirect('login');
        }
        
    }
    
    public function check() {
        $model = new LoginModel();

        if (!$this->validate([
            'user' => 'required|min_length[8]|max_length[30]',
            'password' => 'required|min_length[8]|max_length[30]',
        ])) {
            echo view('templates/header' , ['title' => LOGIN_TITLE]);
            echo view('login/login');
            echo view('templates/footer');
        }
        else {
            $user = $model->check( // Tarkistetaan Modelilla, onko käyttäjä olemassa
            //getVar lukee lomakkeeseen syötetyt tiedot
            $this->request->getVar('user'),
            $this->request->getVar('password') 
            );
            
            if ($user) { // Jos käyttäjä on olemassa, säilytetään se sessiossa
                $_SESSION['user'] = $user;
                return redirect('todo');
            }
            else { // Jos käyttäjää ei ole, ohjataan takaisin login-sivulle
                return redirect('login');
            }
        }

    }
}