<?php namespace App\Controllers;

use App\Models\TodoModel;

class Todo extends BaseController {

    // Construct aloittaa session
    public function __construct() {
        $session = \Config\Services::session();
        $session->start();
    }

    public function index() {
        if (!isset($_SESSION['user'])) {
            return redirect('login');
        }

        $model = new TodoModel();
        $data['title'] = 'To do';
        $data['todos'] = $model->getTodos();
        echo view('templates/header.php', $data);
        echo view('todo/list.php', $data);
        echo view('templates/footer.php', $data);
    }

    public function create() {
        $model = new TodoModel();

        // Syötteiden tarkastus validate-luokalle,
        // if tarkistaa; jos ei mene läpi, näytetään lomake
        if (!$this->validate([
            'title' => 'required|max_length[255]',
        ])){
            echo view('templates/header' , ['title' => 'Add new task']);
            echo view('todo/create');
            echo view('templates/footer');
        }
        else {
            $user = $_SESSION['user'];
            $model->save([ // Modelia käytetään tallentamiseen
                //getVar lukee lomakkeeseen syötetyt tiedot
                'title' => $this->request->getVar('title'),
                'description' => $this->request->getVar('description'),
                'user_id' => $user->id
            ]);

            return redirect('todo');
        }
    }

    //  Poistolla ei ole varmistusta
    public function delete($id) {
        // Varmistetaan, että id on numeerinen
        if (!is_numeric($id)) {
            throw new \Exception('Provided id is not a number.');
        }

        // Varmistetaan sisäänkirjautuneisuus
        if (!isset($_SESSION['user'])) {
            return redirect('login');
        }

        $model = new TodoModel();

        $model->remove($id);
        return redirect('todo');

    }
}