<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $role_user = Role::create(['code' => 'user']);
        $role_admin = Role::create([ 'code' => 'admin']);
        User::create([
            'login'       =>'evseev'  ,
            'email'       =>'evseev@gmail.com'  ,
            'surname'     =>'Евсеев'  ,
            'name'        =>'Дмитрий'  ,
            'patronymic'  =>'Витальевич'  ,
            'sex'         =>1  ,
            'birthday'    =>'2005-11-04'  ,
            'password'    =>'evseev'  ,
            'role_id'     => $role_user->id,
            'api_token'   => null  ,
        ]);

        User::create([
            'login'       =>'vadim'  ,
            'email'       =>'vadim@gmail.com'  ,
            'surname'     =>'Вадим'  ,
            'name'        =>'Вадим'  ,
            'patronymic'  =>'Вадим'  ,
            'sex'         =>1  ,
            'birthday'    =>'2005-06-16'  ,
            'password'    =>'vadim'  ,
            'role_id'     => $role_admin->id,
            'api_token'   => null  ,
        ]);
    }
}
