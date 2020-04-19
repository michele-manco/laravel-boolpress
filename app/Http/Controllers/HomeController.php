 <?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lead;

class HomeController extends Controller
{
    public function index() {
      return view('home');
    }
    public function contatti() {
      return view('contatti');
    }

    public function contattiStore(Request $request) {
      // dd($request->all());
      $new_message = new Lead();
      $new_message->fill($request->all());
      $new_message->save();
    }


};
