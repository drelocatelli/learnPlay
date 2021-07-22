<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClassController extends Controller {


    public function class(){
        return view('painel.class.my');
    }

    public function class_public(){
        return view('painel.class.public');
    }

    public function class_category($category) {

        return view('painel.class.category', compact('category'));

    }

    public function class_search(Request $request){

        return view('painel.class.search', ['query' => $_GET['query']]);

    }


}
