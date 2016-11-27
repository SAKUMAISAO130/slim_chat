<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('users')->truncate();
        
        for ($i=1;$i<100;$i++){
        	DB::table('users')->insert([
        		'name'=>'テスト'.$i,
        		'email'=>'test'.$i.'@example.com',
        		'password'=>bcrypt('password'),
    	 ]);
        	 
        }
        
    }
}
