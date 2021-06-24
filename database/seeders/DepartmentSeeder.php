<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
         Department::create([
            'uuid' => Str::uuid('Comptabilité'),
            'name'=> "Comptabilité",
            'description'=> "Responsable de l'evaluation des flux financier de l'entreprise",
        ]);
         Department::create([
            'uuid' => Str::uuid('Marketing_Vente'),
            'name'=> "Marketing_Vente",
            'description'=> "Responsable de la satisfaction et de la mise en confiance de la clientele",
        ]);
    
         Department::create([
            'uuid' => Str::uuid('Direction_technique'),
            'name'=> "Direction_technique",
            'description'=> "Responsable de la realisation des services offert par l entreprise",
        ]);
         Department::create([
            'uuid' => Str::uuid('Recherche_Developpement'),
            'name'=> "Recherche_Developpement",
            'description'=> "Responsable du developpement progressif de l'entreprise",
        ]);
         Department::create([
            'uuid' => Str::uuid('Communication_Conseil'),
            'name'=> "Communication_Conseil",
            'description'=> "Responsable de l'acheminement des informations capitales à la direction pour améliorer les rendements de l'entreprise",
        ]);
       
    }
}
