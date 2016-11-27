<?php

use Illuminate\Database\Seeder;
use App\Admin;


class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
    	DB::table('admins')->truncate();
    	for ($i=1;$i<100;$i++){
    		DB::table('admins')->insert([
    			'name'=>'テスト'.$i,
    			'email'=>'admin'.$i.'@example.com',
    			'password'=>bcrypt('password'),
    		]);
    	
    	}
    	 
    }
}
