<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\ClassUsers;
use App\Models\Classes;
use App\Models\User\UserAlert;
use Illuminate\Support\Facades\Crypt;

class ClassController extends Controller {

    public function class(){

        $classes = ClassUsers::getClassByUser(Auth::user()->id);

        return view('painel.class.my', compact('classes'));
    }

    public function class_learn(Request $request){

        $class = $this->check_class($request->id);

        if(!$class){
            return redirect()->route('dashboard.notfound');

        }

        $module = $this->class_module($class);

        return view('painel.class.learn', compact('class', 'module'));

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
            if($class->all->password != $request->post('password')){
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
