<?php

namespace App\Http\Controllers\backOffice;

use App\Http\Controllers\Controller;
use App\Models\Bonus;
use App\Models\Demande;
use App\Models\Department;
use App\Models\User;
use App\Notifications\AdminNotification;
use App\Notifications\DemandeNotification;
use App\Notifications\RejectNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function __construct()
    {
        // $this->middleware('admin_action');
        $this->middleware('auth');
    }
 
    // Fonctions communes aux utilisateurs

    public function index()
    {
       $user = Auth::user();
        return view('backOffice.admin.parametre',[
            'user' => $user,
    ]);

    }
    
    public function userProfile()
    {
        
        $user = Auth::user();
        if ($user->role == 'admin') 
        {
            $users = User::all();
            $actif = User::where('admin_action',1)->get();
            $attente = Demande::where('statut','attente')->get();
            $enCours = Demande::where('debut' ,'<=', Now())
            ->where('fin' ,'>', Now())
            ->get();
            $declaration = Bonus::all();
            


            $bonus = Bonus::join('users', 'bonuses.user_id', 'users.id')
            ->where([
                'department_id'=>$user->department_id,
                'statut'=> 'attente',
                'role'=>'employe',
            ])->get();

            $deparTech = Department::where("name",'Direction_technique')->first();
            $deparComp = Department::where("name",'Comptabilité')->first();
            $deparMarkt = Department::where("name",'Marketing_vente')->first();
            $deparRech = Department::where("name",'Recherche_Developpement')->first();
            $deparComu = Department::where("name",'Communication_Conseil')->first();
            // dd($users);
            return view('backOffice.admin.profil',[      
            'users' => $users,
            'actif' => $actif,
            'attente' => $attente,
            'enCours' => $enCours,
            'deparTech' => $deparTech,
            'deparComp' => $deparComp,
            'deparMarkt' => $deparMarkt,
            'deparRech' => $deparRech,
            'deparComu' => $deparComu,
            'declaration' => $declaration,
        ]);
        }
         else
          {
            if ($user->role == 'manager') {


                $activation = User::where('department_id',$user->department_id)
                ->where('admin_action', 0)
                ->where('role','employe')
                ->get();
                $users = User::where('department_id',$user->department_id)->get();
               
                $enCours = Demande::join('users', 'demandes.user_id', 'users.id')
                ->where('department_id',$user->department_id)
                ->where('statut','valid')
                ->where('debut' ,'<=', Now())
                ->where('fin' ,'>', Now())
                ->where('role','employe')
                ->get();
                $demandes = Demande::join('users', 'demandes.user_id', 'users.id')
                ->where('department_id',$user->department_id)
                ->where('role','employe')
                ->get();
                // dd( $demandes);
                $validation = Demande::join('users', 'demandes.user_id', 'users.id')
                ->where('department_id',$user->department_id)
                ->where('statut', 'attente')
                ->where('role','employe')
                ->get();
                $declaration = Bonus::join('users', 'bonuses.user_id', 'users.id')
                ->where([
                    'department_id'=>$user->department_id,
                    'role'=>'employe',
                ])->get();

                $bonus = Bonus::join('users', 'bonuses.user_id', 'users.id')
                ->where([
                    'department_id'=>$user->department_id,
                    'statut'=> 'attente',
                    'role'=>'employe',
                ])->get();

                return view('backOffice.manager.profil',[
                    'users' => $users,
                    'enCours' =>  $enCours,
                    'demandes' => $demandes,
                    'validation' => $validation,
                    'activation' => $activation,
                    'declaration' => $declaration,
                ]);
            }
            else
             {
                $demandes = Demande::join('users', 'demandes.user_id', 'users.id')
                ->where('user_id',$user->id)
                ->get();
              
                $enCours = Demande::join('users', 'demandes.user_id', 'users.id')
                ->where('user_id',$user->id)
                ->where('statut','valid')
                ->where('debut' ,'<=', now())
                ->where('fin' ,'>=', now())
                ->get();
                
                $validation = Demande::join('users', 'demandes.user_id', 'users.id')
                ->where('user_id',$user->id)
                ->where('statut', 'attente')
                ->get();
                
                $department = Department::where('id',$user->department_id)->first();

                $users = User::where('department_id',$department->id)->get();

                $totalCours = Demande::join('users','demandes.user_id', 'users.id')
                ->where('department_id',$user->department_id)
                ->where('statut','valid')
                ->where('debut' ,'<=', now())
                ->where('fin' ,'>=', now())
                ->get();
                // dd($totalCours);

                return view('backOffice.employe.profil',[
                    'user' => $user,
                    'users' => $users,
                    'enCours' =>  $enCours,
                    'demandes' => $demandes,
                    'validation' => $validation,
                    'department' => $department,
                    'totalCours' => $totalCours,
                ]);
            }
        }
    }
   
    public function showUser($uuid)
    {
        $user = User::where('uuid',$uuid)->firstOrfail();
        $demandes = Demande::where('user_id',$user->id)->get();
        $bonus = Bonus::where('user_id',$user->id)->get();
        // dd( $demandes);

        return view('frontOffice.showUser',[
            'users' => $user,
            'demandes' => $demandes,
            'bonus' => $bonus,
        ]);
    }
    
    public function storeAsk(Request $request)
    {
        $users = User::where('role','admin');
        $request->validate([
            'type' => 'required|string|max:55',
            'motif' => ['required', 'string', 'max:1255'],
            'debut' => 'date',
            'fin' =>'date' ,
        ]);
        $debut=Carbon::parse($request->debut)->format('Y-m-d H:i:s');
        $fin=Carbon::parse($request->fin)->format('Y-m-d H:i:s');

        if ($request->type =='Justification')
        
        {
            if ($debut <= $fin) 
            {
           
                $ref= Str::uuid($request).'-'.Str::random(8);
                $user = Auth::user();
                $demande = Demande::create([
                    'ref'=> $ref,
                    'type' => $request->type,
                    'motif' => $request->motif,
                    'debut' => $debut,
                    'fin' => $fin,
                    'user_id' => $user->id,
                ]);
                   
                $demande->save();
    
                $user->notify(new DemandeNotification($demande));
                
                return redirect()->route('showRead', ['item' => $demande])->with('success', 'Votre demande a été envoyer avec succes!');
            } 
            else 
            {
                $ref= Str::uuid($request).'-'.Str::random(8);
                $user = Auth::user();
                $demande = Demande::create([
                    'ref'=> $ref,
                    'type' => $request->type,
                    'motif' => $request->motif,
                    'debut' => $debut,
                    'fin' => $fin,
                    'user_id' => $user->id,
                    ]);

                    $demande->save();
                return redirect()->route('editDemande', ['demande' => $demande])->with('erreur', 'la date de fin doit etre superieur ou egale a la date de debut');    
            }
        }
        else 
        {
            if ($debut <= now()) {
               
                $ref= Str::uuid($request).'-'.Str::random(8);
                $user = Auth::user();
                $demande = Demande::create([
                    'ref'=> $ref,
                    'type' => $request->type,
                    'motif' => $request->motif,
                    'debut' => $debut,
                    'fin' => $fin,
                    'user_id' => $user->id,
                    ]);

                    $demande->save();
                return redirect()->route('editDemande', ['demande' => $demande])->with('erreur', 'la date de debut de votre permission doit etre ulterieur a la date d\'aujourdhui');  
            }
            else
            {
                if ($debut <= $fin) 
              {
                  $ref= Str::uuid($request).'-'.Str::random(8);
                  $user = Auth::user();
                  $demande = Demande::create([
                      'ref'=> $ref,
                      'type' => $request->type,
                      'motif' => $request->motif,
                      'debut' => $debut,
                      'fin' => $fin,
                      'user_id' => $user->id,
                  ]);
                     
                  $demande->save();
      
                  $user->notify(new DemandeNotification($demande));
                  
                  return redirect()->route('showRead', ['item' => $demande])->with('success', 'Votre demande a été envoyer avec succes!');
              } 
              else 
              {
                  $ref= Str::uuid($request).'-'.Str::random(8);
                  $user = Auth::user();
                  $demande = Demande::create([
                      'ref'=> $ref,
                      'type' => $request->type,
                      'motif' => $request->motif,
                      'debut' => $debut,
                      'fin' => $fin,
                      'user_id' => $user->id,
                    
                      ]);
                      $demande->save();
                  return redirect()->route('editDemande', ['demande' => $demande])->with('erreur', 'la date de fin doit etre superieur ou egale a la date de debut');    
              }
               
            }
            
        }
        
            

    }
    public function initieDemande()
    {
        
        $demande = new Demande();
        return view('backOffice.initieDemande',[
            'demande' => $demande,
            'required' => 'required'
        ]);
    }


    public function editDemande( Demande $demande)
    {
        // dd($demande);
        return view('backOffice.initieDemande',[
            'demande' => $demande,
            'required' => ''
        ]);
    }


    public function updateAsk(Request $request, Demande $demande)
    {
        $user = Auth::user();
        $request -> validate([
            'type'=> 'string|min:2',
            'motif' => 'string', 'min:2',
            'debut' => 'date',
            'fin' =>'date' ,
        ]);
        $debut=Carbon::parse($request->debut)->format('Y-m-d H:i:s');
        $fin=Carbon::parse($request->fin)->format('Y-m-d H:i:s');

        if ($debut <= $fin) {
            $demande->update([
                'type' => $request->type,
                'motif' => $request->motif,
                'debut' => $debut,
                'fin' => $fin
            ]);

            $demande->statut = 'attente';
            $demande->save();

            $user->notify(new DemandeNotification($demande));

            return redirect()->route('showRead', ['item' => $demande])->with('success', 'Votre modification a bien été pris en compte !');
        } else 
        {

            $demande->update([
                'type' => $request->type,
                'motif' => $request->motif,
                'debut' => $debut,
                'fin' => $fin
            ]);

            $demande->statut = 'attente';
            return redirect()->route('editDemande', ['demande' => $demande])->with('erreur', 'la date de fin doit etre superieur ou egale a la date de debut');  
        }
    }

    public function destroyAsk(Demande $demande)
    {
        $demande->delete();
        return redirect()->route('showDemande')->with('success', 'La demande a été supprimé avec succès !');
    }

    public function paramUserShow()
    {
        $user = Auth::user();
        return view('backOffice.paramUser',[
            'user' => $user,
    ]);
    }

    public function paramUserUpdate(Request $request, $user)
    {
        $users = User::where('uuid',$user)->first();
        $request->validate([
            'name' => 'required|string|min:2',
            'email' => 'required|string|email|min:2|unique:users,email,'. $users->id,
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|unique:users,phone,' . $users->id,
            
        ]);
        
        $users->update([
            'name'=> $request->name,
            'email'=> $request->email, 
            'phone'=> $request->phone,
        ]);
        return back()->with('success', __ ('Le profil a bien été mis à jour'));
    }

   
    public function pwdUpdate(Request $request, $user)
    {
        $users = User::where('uuid',$user)->first();
        $request->validate([
            'password' => 'required|string|min:6,'. $users->id,
            'new_password' => ['required', 'same:new_password', 'min:8'],
            'new_password_confirmation' => 'required|same:new_password',
        ]);
        if (Hash::check($request->get('password'), $users->password)) 
            
        {
            $users->password = Hash::make($request['new_password']);;
            $users->save();

            Auth::guard('web')->logout();

            $request->session()->invalidate();
    
            $request->session()->regenerateToken();
    
            return redirect('login')->with('success', __ ('Votre mot de passe a été modifier avec succes veuillez voous reconnecter!'));
        } 
        else {
            return back()->with("erreur", __ ('Le mot de passe ne correspond pas'));
        };
    }
    
    public function storeImage($user)
    {

        $users = User::where('uuid',$user)->first();
        // dd($users); 
        if (request('avatar')) { 
            $users->avatar =  request('avatar')->store('avatar', 'public');
            $users->save();
            }
        return back()->with('success', __ ('Le profil a bien été mis à jour'));
    }


    // Fonctions de l admin 
    public function userRole(Request $request, $uuid)
    {
        // dd($request->all());
        $user = User::where('uuid',$uuid)->firstOrfail();
        $request->validate([
            'rol' => 'required',
            ]);
            $user->update([
           'role'=> $request->rol, 
       ]);
     return back()->with('success', __ ('Le profil a bien été mis à jour'));
        
    }

    public function activateUser( $uuid)
    {
        $respo = Auth::user();
        $user = User::where('uuid',$uuid)->first();
        if ( $user->admin_action == 0) {
            $user->admin_action = 1;
            $user->save();

            $respo->notify(new AdminNotification());
            return back()->with('success','Le compte a été activé avec succes');
        } else 
        {
            if ($user->admin_action == 2) {
                $user->admin_action = 1;
                $user->save();

                $respo->notify(new AdminNotification());
                return back()->with('success','Le compte a été activé avec succes');
            }
        }
        
    }
    public function blockUser( $uuid)
    {
        $respo = Auth::user();
        $user = User::where('uuid',$uuid)->first();
        if ( $user->admin_action == 0) {
            $user->admin_action = 2;
            $user->save();
            $respo->notify(new RejectNotification());

            return back()->with('success','Le compte a été bloqué avec succes');
        } else 
        
        {
            if ($user->admin_action == 1) {
                $user->admin_action = 2;
                $user->save();
                $respo->notify(new RejectNotification());
                return back()->with('success','Le compte a été bloqué avec succes');
            }
        }
        
    }

    public function destroy($id)
    {
        //
    }

    public function showEmp()
    {

        $user = Auth::user();

        if ( $user->role == 'admin') {    
            $users = User::all();
            $new = User::where('admin_action', 0)->get();
            return view('frontOffice.showEmp',[
                'users' => $users,
                'new' => $new,
            ]);
        }
        
       if ( $user->role == 'manager') {
           $users = User::where('department_id', $user->department_id)
           ->where('role','employe')
           ->orWhere('role','manager')
           ->where('department_id', $user->department_id)
           ->get();

           $new =  User::where('department_id', $user->department_id)
           ->where('role','employe')
           ->where('admin_action', 0)
           ->get();
           return view('frontOffice.showEmp',[
               'users' => $users,
               'new' => $new,
           ]);
       }
        
    }

}
