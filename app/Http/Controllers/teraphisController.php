<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Teraphi;
use App\job;
use App\Product;

class teraphisController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['history', 'store']]);
    }

    public function index(){
      $teraphis = Teraphi::orderBy('id')->get();
      return view('teraphisPage')->with('teraphis',$teraphis);
    }

    public function baru(){
      $products = Product::all();
      return view('teraphisNew')->with('products', $products);
    }

    public function info(Request $request){
      $teraphis = Teraphi::find($request->id);
      return view('teraphisInfo')->with('teraphis', $teraphis);
    }

    public function save(Request $request){
      $teraphis = Teraphi::where('id',$request->id)->get();
      if($teraphis->count()<=0){
          $teraphis = new Teraphi;
      }
      $teraphis->nama = $request->nama;
      $teraphis->libur = $request->libur;
      $teraphis->spesialis = implode(", ",$request->spesialis);
      $teraphis->save();

      return redirect()->back();
    }
}
