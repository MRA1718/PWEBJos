<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\User;
use App\Wallet;
use App\Income;
use App\Expense;
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
         // return view('pages.income',compact('wallet','incomes'));
            return redirect('/income');
    }




    public function del_income(request $request){


      $id_wallet=Wallet::where('id_user',Auth::user()->id)->first();
      $id_income=Income::where('id',$request->id)->first();
      $hasil=$id_wallet['uang'] - $id_income['biaya_pemasukan'];

      // return view('pages.income');
        $wallet = wallet::find(Auth::user()->id);
      $data =[
        'uang' => $hasil

      ];
      $wallet->update($data);
      $income = Income::find ($request->id)->delete();
      $incomes =income::where('id_user',Auth::user()->id)->get();

         return redirect('/income');
    }

    public function edit_income(request $request){
      $id =$request->id;

      //$post=Post::where('id', $id)->first();


      $income = income::find($id);
      $data =[
        'nama_pemasukan' => $request->nama,
        'biaya_pemasukan' =>$request->biaya,
        'tgl_pemasukan' =>$request->tgl,

      ];
      $income->update($data);

        $wallet = wallet::find(Auth::user()->id);
      $incomes =income::where('id_user',Auth::user()->id)->get();
      // return view('pages.income',compact('wallet','incomes'));
         return redirect('/income');

    }



    public function expense()
    {
        $wallet=wallet::where('id_user',Auth::user()->id)->first();

        $expenses =expense::where('id_user',Auth::user()->id)->get();


       return view('pages.expense',compact('wallet','expenses'));
    }


    public function addExp(Request $request){

          $id=wallet::where('id_user',Auth::user()->id)->first();

          $hasil=$id['uang'] - $request->jmlh;

          // $id =$request->input('post_id');
          //$post=Post::where('id', $id)->first();
          $wallet = wallet::find(Auth::user()->id);
          $data =[
            'uang' => $hasil

          ];
          $wallet->update($data);

          $expense = new expense;
          $expense->id_user =  Auth::user()->id;
          $expense->nama_pengeluaran = $request->nama_peng;
          $expense->biaya_pengeluaran = $request->jmlh;
          $expense->tgl_pengeluaran = $request->tgl;
          $expense->save();
          $expenses =expense::where('id_user',Auth::user()->id)->get();
         // return view('pages.expense',compact('wallet','expenses'));
            return redirect('/expense')->with('alert', 'deleteSuccess');

    }

    public function del_expense(request $request){


      $id_wallet=Wallet::where('id_user',Auth::user()->id)->first();
      $id_expense=Expense::where('id',$request->id)->first();
      $hasil=$id_wallet['uang'] + $id_expense['biaya_pengeluaran'];

      // return view('pages.income');
        $wallet = wallet::find(Auth::user()->id);
      $data =[
        'uang' => $hasil

      ];
      $wallet->update($data);
      $exoense = Expense::find ($request->id)->delete();
      $expenses =Expense::where('id_user',Auth::user()->id)->get();

      // return view('pages.expense',compact('wallet','expenses'));
       return redirect('/expense')->with('alert', 'deleteSuccess');
    }

    public function edit_expense(request $request){
      $id =$request->id;

      //$post=Post::where('id', $id)->first();


      $expense = expense::find($id);
      $data =[
        'nama_pengeluaran' => $request->nama,
        'biaya_pengeluaran' =>$request->biaya,
        'tgl_pengeluaran' =>$request->tgl,

      ];
      $expense->update($data);

        $wallet = wallet::find(Auth::user()->id);
      $expenses =expense::where('id_user',Auth::user()->id)->get();
      // return view('pages.expense',compact('wallet','expenses'));
         return redirect('/expense')->with('alert', 'deleteSuccess');
    }

}
