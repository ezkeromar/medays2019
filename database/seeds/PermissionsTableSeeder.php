<?php

use App\Models\ParticipantType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;
use jeremykenedy\LaravelRoles\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //$types = Config::get('meDays.participant.types');
        $types = ParticipantType::all();

        foreach ($types as $type) {
            Permission::create([
                'name'                => $type['name'],
                'slug'                => $type['name'],
                'description'         => 'Can Manage ' . $type['name'],
                'model'               => 'Permission',
                'participant_type_id' => $type->id,
            ]);
        }

        Permission::create([
            'name'                => 'Upgrade',
            'slug'                => 'upgrade',
            'description'         => 'Can upgrade participants',
            'model'               => 'Permission',
            'participant_type_id' => null,
        ]);

        Permission::create([
            'name'                => 'Supprimer',
            'slug'                => 'delete',
            'description'         => 'Can delete participants',
            'model'               => 'Permission',
            'participant_type_id' => null,
        ]);
    }
}
