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
          $coba = array(
            'nama_pem' => $request->nama_pem,
            'jmlh' =>  $request->jmlh,
            'tgl' =>  $request->tgl,
          );



            $id=wallet::where('id_user',Auth::user()->id)->first();

          $hasil=$id['uang'] + $request->jmlh;

          $id =$request->input('post_id');
          //$post=Post::where('id', $id)->first();
          $wallet = wallet::find(Auth::user()->id);
          $data =[
            'uang' => $hasil

          ];
          $wallet->update($data);


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


    public function del_income(request $request){
      $income = Income::find ($request->id)->delete();
      $id_wallet=Wallet::where('id_user',Auth::user()->id)->first();
      $id_income=Income::where('id',$request->id);
      $hasil=$id['uang'] - $id_income['biaya_pemasukan'];
      // return view('pages.income');

      $data =[
        'uang' => $hasil

      ];
      $wallet->update($data);



      // return response()->json($income);

    }



}
