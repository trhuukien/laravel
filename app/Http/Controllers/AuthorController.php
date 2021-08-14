<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;

class AuthorController extends Controller
{
    public function index() {
        if(isset($_GET['search'])) {
            $key = $_GET['search'];
            $authors = Author::where("name", "like", "%$key%")->get();
        } else {
            $authors = Author::all();
        }

        if(isset($_GET['embed'])) {
            $authors->load('comics');
        }

        return $authors;
    }

    public function get($id) {
        $authors = Author::find($id);
        
        if(isset($_GET['embed'])) {
            $authors->load('comics');
        }
        
        return $authors;
    }

    public function add(Request $data) {
        $model = new Author();
        $model->fill($data->input());
        $model->save();
        return $model;
    }

    public function update(Request $data) {
        $model = Author::find($data->id);
        $model->fill($data->input());
        $model->save();
        return $model;
    }

    public function delete($id) {
        return Author::find($id)->delete();
    }
}
