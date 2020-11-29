<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	
   		$sql = file_get_contents(database_path('seeds/booksi_sql.sql'));
		DB::unprepared($sql);
        $this->command->info('Demo table seeded!');
    }
}
