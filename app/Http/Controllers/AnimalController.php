<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnimalController extends Controller
{
        public $animals;

        public function __construct() {
            $this->animals = ['Ayam', 'Ikan'];
        }

        public function index() {
            foreach ($this->animals as $animal) {
                echo $animal . '<br>';
            }
        }

        public function store(request $request) {
            $animal = $request->input('animal');
            array_push($this->animals, $animal);
            echo "Hewan $animal telah ditambahkan.";
        }

        public function update(Request $request, $id) {
            $newAnimal = $request->input('animal');
            $this->animals[$id] = $newAnimal;
            echo "Hewan pada posisi $id telah diperbarui menjadi $newAnimal $id";
        }
        public function destroy($id) {
            unset($this->animals[$id]);
            $this->animals = array_values($this->animals);
            echo "Hewan pada posisi $id telah dihapus $id";
        }
    }

?>
