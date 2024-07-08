<?php

namespace App\Http\Controllers;
use App;
use Illuminate\Http\Request;
use Stichoza\GoogleTranslate\GoogleTranslate;


class LangController extends Controller
{
    public function index(){
       return view('welcome');
    }

    public function change(Request $request){
        App::setLocale($request->lang);
        session()->put('locale',$request->lang);
        return redirect()->back();
    }
}
