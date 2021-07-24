<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Classes;

class ClassController extends Controller {

    public function class(){
        return view('painel.class.my');
    }

    public function class_public(){
        $classes = Classes::getClasses();

        return view('painel.class.public', compact('classes'));
    }

    public function class_category($category) {

        $category = ucfirst(urldecode($category));

        $classes = Classes::getClasses($category);

        return view('painel.class.category', compact('category', 'classes'));

    }

    public function class_search(Request $request){
        $name = ucfirst(urldecode($_GET['query']));

        $classes = Classes::searchClass($name);

        return view('painel.class.search', ['query' => $name, 'classes'=>$classes]);

    }


}
