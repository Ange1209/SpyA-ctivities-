<?php

namespace App\Http\Controllers\backOffice;

use App\Http\Controllers\Controller;
use App\Models\Bonus;
use App\Models\Notification;
use App\Models\User;
use App\Notifications\DemandeNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class BonusController extends Controller
{
   

       
  
    public function initieBonus()
    {
        
        $bonus = new Bonus();
        return view('backOffice.initieBonus',[
            'bonus' => $bonus,
            'required' => 'required'
        ]);
    }

    public function storeBonus(Request $request)
    {

        $request->validate([
            'type' =>['required', 'string', 'max:55'],
            'motif' => ['required', 'string', 'max:1255'],
            'debut' => 'date',
            'fin' =>'date' ,
        ]);
            // dd( $request->type);
        $debut=Carbon::parse($request->debut)->format('Y-m-d H:i:s');
        $fin=Carbon::parse($request->fin)->format('Y-m-d H:i:s');

        if ($debut >= now()) {
            $ref= Str::uuid($request).'-'.Str::random(8);
            $user = Auth::user();
            $bonus = Bonus::create([
                'ref'=> $ref,
                'type' => $request->type,
                'motif' => $request->motif,
                'debut' => $debut,
                'fin' => $fin,
                'user_id' => $user->id,
            ]);  
            $bonus->save();            
            return redirect()->route('editBonus', ['bonus' => $bonus])->with('success', 'Impossible de déclarer un bonus à l\'avance ');  

        } else {

            if ($debut >= $fin) {
                $ref= Str::uuid($request).'-'.Str::random(8);
                $user = Auth::user();
                $bonus = Bonus::create([
                    'ref'=> $ref,
                    'type' => $request->type,
                    'motif' => $request->motif,
                    'debut' => $debut,
                    'fin' => $fin,
                    'user_id' => $user->id,
                ]);
                   
                $bonus->save();
                
                return redirect()->route('editBonus', ['bonus' => $bonus])->with('success', 'la date de fin doit être superieur ou égale a la date de début');     
            } else {
                
                 $ref= Str::uuid($request).'-'.Str::random(8);
                 $user = Auth::user();
                 $bonus = Bonus::create([
                     'ref'=> $ref,
                     'type' => $request->type,
                     'motif' => $request->motif,
                     'debut' => $debut,
                     'fin' => $fin,
                     'user_id' => $user->id,
                 ]);
                    
                 $bonus->save();
         
                 // $user->notify(new DemandeNotification($demande));
                 
                 return redirect()->route('showBonus', ['item' => $bonus])->with('success', 'Votre déclaration a été envoyé avec succes!');     

            }
            
        }
        

    }
    public function editBonus( Bonus $bonus)
    {
        // dd($demande);
        return view('backOffice.initieBonus',[
            'bonus' => $bonus,
            'required' => ''
            
        ]);
    }

    public function updateBonus(Request $request, Bonus $bonus)
    {
        $user = Auth::user();
        $request -> validate([
            'type' => ['required', 'string', 'max:55'],
            'motif' => ['required', 'string', 'max:1255'],
            'debut' => 'date',
            'fin' =>'date' ,
        ]);
        // dd($demande);

        $debut=Carbon::parse($request->debut)->format('Y-m-d H:i:s');
        $fin=Carbon::parse($request->fin)->format('Y-m-d H:i:s');

        if ($debut >= $fin) {
            $bonus->update([
                'type' => $request->type,
                'motif' => $request->motif,
                'debut' => $debut,
                'fin' => $fin
            ]);

            $bonus->statut = 'attente';
            $bonus->save();

                return redirect()->route('editBonus', ['bonus' => $bonus])->with('success', 'la date de fin doit être superieur ou égale a la date de début');     
        } else 
        {
            if ($debut >= now()) {
                $ref= Str::uuid($request).'-'.Str::random(8);
                $user = Auth::user();
                $bonus = Bonus::create([
                    'ref'=> $ref,
                    'type' => $request->type,
                    'motif' => $request->motif,
                    'debut' => $debut,
                    'fin' => $fin,
                    'user_id' => $user->id,
                ]);  
                $bonus->statut = 'attente';
                $bonus->save();  
          
                return redirect()->route('editBonus', ['bonus' => $bonus])->with('success', 'Impossible de déclarer un bonus à l\'avance ');  
    
            } else 
            {
                $bonus->update([
                    'type' => $request->type,
                    'motif' => $request->motif,
                    'debut' => $debut,
                    'fin' => $fin
                ]);

                $bonus->statut = 'attente';
                $bonus->save();  
                return redirect()->route('showBonus', ['item' => $bonus])->with('success', 'Votre modification a bien été pris en compte');     
            }
        }

    }

    public function destroyBonus(Bonus $bonus)
    {
        $bonus->delete();
        return redirect()->route('allBonus')->with('success', 'La déclaration a été supprimé avec succès!');
    }

    public function showBonus($item)
    {
        $bonus = Bonus::join('users', 'bonuses.user_id', 'users.id')
        ->where('ref',$item)
        ->first();
        $notif = Notification::join('bonuses','notifications.bonus_id','bonuses.id')
        ->first();
        $user = User::where('id',$notif->manager_id)->first();
        $validation = Bonus::join('users','bonuses.user_id','users.id')
        ->where([['statut','!=','valid']]) 
        ->get();

        return view('backOffice.manager.employe.showBonus',[
            'bonus' => $bonus,
            'notif' => $notif,
            'user' => $user,
            'validation' => $validation,
        ]);

    }

    public function bonusShow()
    {
        // dd($users);
        $user = Auth::user();
        $bonus = Bonus::where('user_id',$user->id)
        ->where('statut','refus')
        ->orWhere('statut','valid')
        ->where('user_id',$user->id)
        ->get();
        // dd($bonus);
        $today = Bonus::where('user_id',$user->id)
        ->where('statut','valid')
        ->where('debut' ,'<=', now())
        ->where('fin' ,'>=', now())
        ->get();
        $validation = Bonus::where('user_id',$user->id)
        ->where('statut','attente')
        ->get();
        //    dd($validation);

        return view('frontOffice.bonusShow',[
            'user' => $user,
            'bonus' => $bonus,
            'today' => $today,           
            'validation' => $validation,           
        ]);

        
    }
    
   
}
