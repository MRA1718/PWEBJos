<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\User;
use App\Wallet;
use App\Income;
use Illuminate\Support\Facades\Input;
use Validator;
use Response;
use Auth;

class MainController extends Controller
{
    //
    public function index()
    {

       return view('pages.landing');
    }

    public function income()
    {
        $wallet=wallet::where('id_user',Auth::user()->id)->first();

        $incomes =income::where('id_user',Auth::user()->id)->get();


       return view('pages.income',compact('wallet','incomes'));
    }

    public function store_money(Request $request)
    {
      // $id=Auth::user()->id;
      // $user= User::find($id);
      //
      // $wallet=new App\wallet([
      //   'uang' => $request->input('uang')
      // ]);
      //
      //  $user->wallet()->save($wallet);
      $walleet=wallet::where('id_user',Auth::user()->id)->first();
      if($walleet==null)
      {
        $wallet= new wallet;
        $wallet->id_user = Auth::user()->id;
        $wallet->uang =  $request->uang;
        $wallet->save();
      }
      else
      {
        $walleet->uang=$walleet->uang+$request->uang;
        $walleet->save();
      }
      return redirect('/home');

    }

    public function addPost(Request $request){
          $rules = array(
            'nama_pem' => 'required',
            'jmlh' => 'required',
            'tgl' => 'required',
          );
          $coba = array(
            'nama_pem' => $request->nama_pem,
            'jmlh' =>  $request->jmlh,
            'tgl' =>  $request->tgl,
          );

          $wallet = new wallet;

          $wallet=wallet::where('id_user',Auth::user()->id)->first();

          $hasil=$wallet['uang'] + $request->jmlh;

          $income = new income;
          $income->id_user =  Auth::user()->id;
          $income->nama_pemasukan = $request->nama_pem;
          $income->biaya_pemasukan = $request->jmlh;
          $income->tgl_pemasukan = $request->tgl;
          $income->save();
            $incomes =income::where('id_user',Auth::user()->id)->get();
           return view('pages.income',compact('wallet','incomes'));

    }

    public function editPost(request $request){
      $post = Post::find ($request->id);
      $post->title = $request->title;
      $post->body = $request->body;
      $post->save();
      return response()->json($post);
    }


}
