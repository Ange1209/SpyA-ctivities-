<?php

namespace App\Http\Controllers\backOffice;

use App\Http\Controllers\Controller;
use App\Models\Bonus;
use App\Models\Demande;
use App\Models\Notification;
use App\Models\User;
use App\Notifications\DemandeRefus;
use App\Notifications\ValidationDemande;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class ManagerController extends Controller
{
    public function __construct()
    {
        // $this->middleware('admin_action');
        $this->middleware('auth');
    }
   
    public function index()
    {
        
    }

//Plus de details demande

    public function demandes()
    {
        // dd('ok');
        $user = Auth::user();

        if ($user->role == 'manager') {

            $users = User::where('department_id',$user->department_id)->get();
           
            $enCours = Demande::join('users', 'demandes.user_id', 'users.id')
            ->where('department_id',$user->department_id)
            ->where('debut' ,'<=', now())
            ->where('fin' ,'>', now())
            ->where('statut','valid')
            ->where('role','employe')
            ->get();
            // dd($enCours);  
            $demandes = Demande::join('users', 'demandes.user_id', 'users.id')
            ->where('department_id',$user->department_id)
            ->where('role','employe')
            ->where('statut','refus')
            ->orWhere('statut','valid')
            ->where('department_id',$user->department_id)
            // ->where('role','employe')
            ->get();
            // dd($demandes);
            $validation = Demande::join('users', 'demandes.user_id', 'users.id')
            ->where('department_id',$user->department_id)
            ->where('statut', 'attente')
            ->where('role','employe')
            // ->where('debut' ,'>=', Carbon::today())
            ->get();
           
            // dd($validation);
            
           

            return view('backOffice.manager.demandeShow',[
                'users' => $users,
                'enCours' =>  $enCours,
                'demandes' => $demandes,
                'validation' => $validation,
            ]);
        }
        
        if ($user->role == 'admin') {

            $enCours = Demande::join('users', 'demandes.user_id', 'users.id')
            ->where('debut' ,'<=', now())
            ->where('fin' ,'>', now())
            ->where('statut','valid')
            ->get();

            $demandes = Demande::join('users', 'demandes.user_id', 'users.id')
            ->where('statut','valid')
            ->orWhere('statut','refus')
            ->get();

            // dd($demandes);
            $validation = Demande::join('users', 'demandes.user_id', 'users.id')
            ->where('statut', 'attente')
            ->get();
           
            // dd($validation);
            
           

            return view('backOffice.manager.demandeShow',[
                'enCours' =>  $enCours,
                'demandes' => $demandes,
                'validation' => $validation,
            ]);
        }
        
    }

    public function validAsk($demande)
    {
        $user = Auth::user();
        $demande = Demande::where('ref',$demande)->first();

        // dd($demande);

        if ( $demande->statut == 'attente') 
        {
            $demande->statut = 'valid';
            $demande->save();

            $user->notify(new ValidationDemande($demande));
            return back()->with('success','La demande a été validé avec succes');
         }
    }


    public function refusAsk($demande)
    {
        $user = Auth::user();
        $demande = Demande::where('ref',$demande)->first();

        if ( $demande->statut == 'attente') 
        {
            $demande->statut = 'refus';
            $demande->save();
            $user->notify(new DemandeRefus($demande));

            return back()->with('success','La demande a été refusé ');
         }
    }
    
    public function showRead($item)
    {
        $demande = Demande::join('users', 'demandes.user_id', 'users.id')
        ->where('ref',$item)
        ->first();
        return view('backOffice.manager.employe.showAsk',[
            'demande' => $demande,
        ]);

    }

    public function bonus()
    {

        $user = Auth::user();
        if($user->role == 'manager') {
            $users = User::where('department_id',$user->department_id)->get();
            $bonus = Bonus::join('users','bonuses.user_id','users.id')->where([
                ['department_id',$user->department_id],
                ['statut','!=','attente'],
                ['role','employe'],
            ])->get();
            
            $validation = Bonus::join('users','bonuses.user_id','users.id')->where([
                ['department_id',$user->department_id],
                ['statut','attente'],
                ['role','employe'],
            ])->get();

            $valid = Bonus::join('users','bonuses.user_id','users.id')
            ->where([
                ['department_id',$user->department_id],
                ['statut','valid'],
            ])->get();
            $send = 0;
            
            $record = collect(); 
            foreach ($users as $supp) 
            {
               $userBonus = Bonus::where([
                'user_id'=>$supp->id,
                'type'=>'heures_supplementaires',
               ])->get();
              //    dump($userBonus);

               if ($userBonus->count()>0) {
                  $nbrHeure = 0;
                    foreach ($userBonus as $userBonus) {
                  $debut =  Carbon::parse($userBonus->debut);
                  $fin =  Carbon::parse($userBonus->fin);
                  $nbrHeure =floor($nbrHeure +((strtotime($fin)-strtotime($debut))/3600));
                  }
                     $record->push(['nbrHeure'=>$nbrHeure,'id'=>$supp->uuid, 'name'=>$supp->name]);
                }
            
            
            }
            $theBest = $record->sortDesc()->take(3);
            // dd($theBest);

            return view('backOffice.allBonus',[
                'users' => $users,
                'valid' => $valid,
                'bonus' => $bonus,
                'validation' =>$validation,
                'send' => $send,
                'theBest' => $theBest,
            ]);
        }
        
        if ($user->role == 'admin') {
            $users = User::all();
            $bonus = Bonus::join('users','bonuses.user_id','users.id')->where([
                ['statut','!=','attente'],
            ])->get();
            $validation = Bonus::join('users','bonuses.user_id','users.id')
            ->where([['statut','!=','valid']]) 
            ->get();

            $record = collect(); 
            foreach ($users as $supp) 
            {
               $userBonus = Bonus::where([
                'user_id'=>$supp->id,
                'type'=>'heures_supplementaires',
               ])->get();

               if ($userBonus->count()>0) {
                  $nbrHeure = 0;
                    foreach ($userBonus as $userBonus) {
                  $debut =  Carbon::parse($userBonus->debut);
                  $fin =  Carbon::parse($userBonus->fin);
                  $nbrHeure = floor($nbrHeure +((strtotime($fin)-strtotime($debut))/3600));
                  }
                     $record->push(['nbrHeure'=>$nbrHeure,'id'=>$supp->uuid, 'name'=>$supp->name]);
                }
            }
            $theBest = $record->sortDesc()->take(3);
            $send = 0;

            return view('backOffice.allBonus',[
                'bonus' => $bonus,
                'validation' =>$validation,
                'send' => $send,
                'theBest' => $theBest,
            ]);
        }
    }
   
    public function validBonus($bonus)
    {
        $user = Auth::user();
        $bonus = Bonus::where('ref',$bonus)->first();

        // dd($demande);

        if ( $bonus->statut == 'attente') 
        {
            $bonus->statut = 'valid';
            $bonus->save();

            // $user->notify(new ValidationDemande($demande));
            return back()->with('success','La déclaration a été validé avec succes');
         }
    }

    public function refusBonus($bonus)
    {
        $user = Auth::user();
        $bonus = Demande::where('ref',$bonus)->first();

        if ( $bonus->statut == 'attente') 
        {
            $bonus->statut = 'refus';
            $bonus->save();
            // $user->notify(new DemandeRefus($demande));

            return back()->with('success','La déclaration a été refusé ');
         }
    }


    public function bonusNotif()
    {
        
    }

    
    public function storeNotif(Request $request,Bonus $bonus)

    {
        // dd( $bonus);

        $request->validate([
            'description' => ['required', 'string', 'max:1255'],
        ]);
            // dd( $request->type);
    
      
            $ref= Str::uuid($request).'-'.Str::random(8);
            $user = Auth::user();
            $notif = Notification::create([
                'ref'=> $ref,
                'description' => $request->description,
                'user_id' => $user->id,
                'bonus_id' => $bonus->id,
            ]);
            $notif->save(); 
            $bonus->statut = 'en_cours';
            $bonus->save(); 

                       
            return back()->with('success', 'La déclaration à été envoyé à l\'administrateur');  
       
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
