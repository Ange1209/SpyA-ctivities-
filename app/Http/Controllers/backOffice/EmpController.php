<?php

namespace App\Http\Controllers\backOffice;

use App\Http\Controllers\Controller;
use App\Models\Bonus;
use App\Models\Demande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmpController extends Controller
{
    //employe demande

    public function askShow()
    {
        // dd('po');
        $user = Auth::user();
        $demandes = Demande::where('user_id',$user->id)
        ->where('statut','refus')
        ->orWhere('statut','valid')
        ->where('user_id',$user->id)
        ->get();
        // dd($demandes);
        $today = Demande::where('user_id',$user->id)
        ->where('statut','valid')
        ->where('debut' ,'<=', now())
        ->where('fin' ,'>=', now())
        ->get();
        $validation = Demande::where('user_id',$user->id)
        ->where('statut','attente')
        ->get();
        //    dd($validation);

        return view('frontOffice.demandeShow',[
            'user' => $user,
            'demandes' => $demandes,
            'today' => $today,           
            'validation' => $validation,           
        ]);

        
    }

   
   
    public function store(Request $request)
    {
        //
    }

   
    public function show($id)
    {
        //
    }

  
    public function edit($id)
    {
        //
    }

   
    public function update(Request $request, $id)
    {
        //
    }

   
    public function destroy($id)
    {
        //
    }
}
