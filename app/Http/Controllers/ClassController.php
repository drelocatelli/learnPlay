<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\ClassUsers;
use App\Models\Classes;
use App\Models\User\UserAlert;
use App\Models\Category;
use App\Models\ClassModule;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Crypt;

class ClassController extends Controller {

    public function class(){

        $classes = ClassUsers::with(['classes'])
                            ->where('id_user', Auth::id())
                            ->get();

        return view('painel.class.my', compact('classes'));
    }

    public function class_create(Request $request){

        if($request->POST()){

            if($newClass = Classes::newClass($request->all(), Auth::user()->id)){
                ClassUsers::matricular([
                    'id_class' => $newClass->id,
                    'id_user' => Auth::user()->id
                ]);
                UserAlert::newAlert("Você gerencia a aula $request->title", Auth::user()->id);
                return redirect()->route('dashboard.class');
            }

        }

        $category = Category::get();

        return view('painel.class.new', compact('category'));

    }

    public function userInClass($classUsers, $user){

        $userInClass = in_array($user, array_column($classUsers, 'id'));

        return !$userInClass;

    }

    public function class_learn(Request $request){

        $class = $this->check_class($request->id);

        $verify_userInClass = $this->userInClass($class->users->toArray(), Auth::user()->id);

        if(!$class || $verify_userInClass){
            return redirect()->route('dashboard.notfound');
        }

        $module = new ClassModule();
        $grade = $module->with('chapters')
        ->where('id_class', $request->id)
        ->get();

        return view('painel.class.learn', compact('class', 'grade'));

    }

    public function class_module($class){

        $module = Classes::getModules($class->all->id);

        return $module;

    }


    public function class_page(Request $request, $className = null){

        $class = $this->check_class($request->id);

        if(!$class){
            return redirect()->route('dashboard.notfound');
        }

        // verifica a senha da aula

        if($request->post() && $class->all->tipo_restricao == 'senha'){
            if(!(Hash::check($request->password, $class->all->password))){
                return back()->withErrors('password');
            }else{
                // acertou a senha matricula o estudante
                return $this->class_matricula($request);
            }
        }

        return view('painel.class.page', compact('class'));

    }

    public function check_class($id){
        $class = new \StdClass();
        if(!(bool) Classes::getClassById($id)){
            $class = false;

        }else{
            $class->title = Classes::getClassById($id)->titulo;
            $class->all = Classes::getClassById($id);
            if($class->all->tipo_restricao == 'password'){ $class->all->tipo_restricao = 'senha'; }
            $class->all->timestamp = new \DateTime($class->all->timestamp);
            $class->all->timestamp = $class->all->timestamp->format('d/m/Y à\s H:i');
            $class->users = Classes::getClassUsers($id);
        }

        return $class;
    }

    public function class_leave(Request $request){

        $className = Classes::getClassById($request->id)->titulo;

        UserAlert::newAlert("Você saiu da aula $className", Auth::user()->id);

        ClassUsers::leave([
            'id_class' => $request->id,
            'id_user' => Auth::user()->id
        ]);


        if($request->redirect){
            $path = Crypt::decrypt($request->redirect);


            if($path != 'dashboard.class.leave'){
                return redirect()->route('dashboard.class');
            }

        }


        return back();
    }

    public function class_matricula(Request $request){

        $className = Classes::getClassById($request->id)->titulo;

        UserAlert::newAlert("Você ingressou na aula $className", Auth::user()->id);

        ClassUsers::matricular([
            'id_class' => $request->id,
            'id_user' => Auth::user()->id
        ]);

        return back();

    }

    public function class_public(){
        $classes = Classes::getClasses(Auth::user()->id);

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
