<?php

namespace App\Http\Controllers\backOffice;

use App\Http\Controllers\Controller;
use App\Models\Bonus;
use App\Models\Demande;
use App\Models\Department;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        // $this->middleware('admin_action');
        $this->middleware('auth');
    }


    public function index()
    {
        //
    }

    
    public function showDep(Department $department)
    {
        $users = User::where('department_id',$department->id)->get();
        $demandes = Demande::join('users','demandes.user_id', 'users.id')
        ->where('department_id',$department->id)
        ->get();
        $attentes = Demande::join('users','demandes.user_id', 'users.id')
        ->where('department_id',$department->id)
        ->where('statut','attente')
        ->get();
        $enCours = Demande::join('users','demandes.user_id', 'users.id')
        ->where('department_id',$department->id)
        ->where('statut','valid')
        ->where('debut' ,'<=', Carbon::today())
        ->where('fin' ,'>', Carbon::today())
        ->get();
        $manager = User::where('department_id',$department->id)
        ->where('role','manager')
        ->first();

        $bonus = Bonus::join('users','bonuses.user_id', 'users.id')
        ->where([
                ['department_id',$department->id],
        ])->get();
        // dd($bonus);
        return view('backOffice.admin.showDep',
        [
            'department' => $department,
            'users' => $users,
            'demandes' => $demandes,
            'manager' => $manager,
            'attentes' => $attentes,
            'enCours' => $enCours,
            'bonus' => $bonus,
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
