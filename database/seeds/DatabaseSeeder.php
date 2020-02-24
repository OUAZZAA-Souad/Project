<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        DB::table('cities')->delete();

		$now = date('Y-m-d H:i:s');
		$city = [
			'Rabat',
			'Casa',
			'Tangier',
		];
	
		for($i = 0; $i < count($city); $i++)
		{
			DB::table('cities')->insert(
				array(
					'name' => $city[$i],
					'created_at' => $now,
					'updated_at' => $now
				)
			);
        }
        

        DB::table('partners')->delete();

		 
        $partners = collect([['name' => 'Mohamed','products'=>'flowers, chocolate','city'=>'Rabat'], ['name' => 'Hassan','products'=>'flowers, perfumes, chocolate','city'=>'Casa'], ['name' => 'Nada','products'=>'flowers','city'=>'Tangier']]);
   
		

        foreach ($partners as $k => $partner) 
		{
            $id_city =DB::table('cities')->where('name', '=', $partner['city'])->get('id_city')->first();
			DB::table('partners')->insert(
				array(
                    'name' => $partner['name'],
                    'products' => $partner['products'],
					'id_city' => intval($id_city->id_city),
					'created_at' => $now,
					'updated_at' => $now
				)
			);
		}
    
    
}
}