<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * ///only one SeederTable  php artisan db:seed --class=UserSeeder,
     */
    public function run()
    {
        $permissions=['all','user-create','user-edit','user-delete','user-list','post-create'];
        foreach($permissions as $permission){
            Permission::updateOrCreate(['name'=>$permission]);
        }
        $roles = ['Admin','user'];
        foreach($roles as $role){
           $roles = Role::updateOrCreate(['name'=>$role]);
        }

        $userCount = max((int)$this->command->ask('How many users would  you like?',20),1);
        // \App\Models\User::factory()->newUser()->create();
        $user = \App\Models\User::updateOrCreate(['email' => 'test@gmail.com'],[
            'name'=>'Admin',
            'email' => 'test@gmail.com',
            'username'=>'test',
            'status' => TRUE,
            'parent_id' => 0,
            'company_name' =>'dev',
            'mobile_number' =>123456789,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => 'dsadadlasdasdsada',
        ]);
        $user->assignRole(['Admin']);
        $user->givePermissionTo(['all']);
        $user->save();
        \App\Models\User::factory($userCount)->make()->each(function($user) use($userCount){
            $user->parent_id = random_int(0,$userCount);
            $user->status = random_int(0,1);
            $user->assignRole(['user']);
            $user->save();
        });
        $role= Role::where('name','Admin')->first();
        $role->givePermissionTo($permissions);




    }
}
