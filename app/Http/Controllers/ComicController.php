<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comic;

class ComicController extends Controller
{
    public function index()
    {
        // if(isset($_GET['search'])) {
        //     $key = $_GET['search'];
        //     $comics = Comic::where("name", "like", "%$key%")->get();
        // } else {
        //     $comics = Comic::all();
        // }

        // if(isset($_GET['expand'])) {
        //     $comics->load('category');
        //     $comics->load('author');
        // }
        $comics = Comic::all();
        // 'select * from comic'

        return $comics;
    }

    public function get($id)
    {
        $comics = Comic::find($id);

        if (isset($_GET['expand'])) {
            $comics->load('category');
            $comics->load('author');
        }

        return $comics;
    }

    public function where($id_cate, $id_author)
    {
        if ($id_cate > 0) {
            if ($id_author > 0) {
                $comics = Comic::where('category_id', $id_cate)->where('author_id', $id_author);
            } else {
                $comics = Comic::where('category_id', $id_cate);
            }
        } else {
            if ($id_author > 0) {
                $comics = Comic::where('author_id', $id_author);
            } else {
                $comics = Comic::where('name', 'like', '%');
            }
        }

        if (isset($_GET['desc'])) {
            $comics = $comics->orderBy('views', 'desc');
        } elseif (isset($_GET['asc'])) {
            $comics = $comics->orderBy('views', 'asc');
        }

        if (isset($_GET['search'])) {
            $key = $_GET['search'];
            $comics = $comics->where("name", "like", "%$key%");
        }

        $comics = $comics->get();

        if (isset($_GET['expand'])) {
            $comics->load('category');
            $comics->load('author');
        }

        return $comics;
    }

    public function add(Request $data)
    {
        $model = new Comic();
        $model->fill($data->input());
        $model->save();
        return $model;
    }

    public function update(Request $data)
    {
        $model = Comic::find($data->id);
        $model->fill($data->input());
        $model->save();
        return $model;
    }

    public function delete($id)
    {
        return Comic::find($id)->delete();
    }
}
