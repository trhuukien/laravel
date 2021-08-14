<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

use Illuminate\Support\Facades\Mail;

class CategoryController extends Controller
{
    public function index()
    {
        if (isset($_GET['search'])) {
            $key = $_GET['search'];
            $cates = Category::where("name", "like", "%$key%")->get();
        } else {
            $cates = Category::all();
        }

        if (isset($_GET['embed'])) {
            $cates->load('comics');
        }

        return $cates;
    }

    public function get($id)
    {
        $cates = Category::find($id);

        if (isset($_GET['embed'])) {
            $cates->load('comics');
        }

        return $cates;
    }

    public function add(Request $data)
    {
        $model = new Category();
        $model->fill($data->input());
        $model->save();
        return $model;
    }

    public function update(Request $data)
    {
        $model = Category::find($data->id);
        $model->fill($data->input());
        $model->save();
        return $model;
    }

    public function delete($id)
    {
        return Category::find($id)->delete();
    }

    public function sendMail()
    {
        $data = [
            'name' => "Trần Hữu Kiên"
        ];
        Mail::send('mail', $data, function ($message) {
            $message->from('kientrantc@gmail.com', 'Admin Kizshop');
            $message->to('trhuukien2001@gmail.com', 'Member');
            $message->subject('Reset Password Kizshop');
        });
    }
}
