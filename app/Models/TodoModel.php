<?php namespace App\Models;

use CodeIgniter\Model;

class TodoModel extends Model {
    protected $table = 'task';

    protected $allowedFields = ['title', 'description','user_id'];

    public function getTodos() {
        $this->table('task');
        $this->select('title, description, firstname, lastname, task.id AS id');
        $this->join('user_data' , 'user_data.id = task.user_id');
        $query = $this->get();

        return $query->getResultArray();
        // return $this->findAll();
    }

    // Poistetaan valittu kohta tietokannasta
    public function remove($id) {
        $this->where('id', $id);
        $this->delete();
    }
}