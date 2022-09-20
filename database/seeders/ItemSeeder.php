<?php

namespace Database\Seeders;

use App\Models\Item; // Include this import. Without this, you can not access the Institution model
use Illuminate\Database\Seeder; // This import comes by default
use Illuminate\Support\Facades\DB; // Include this import. Without this, you can not access the institutions database table
use Illuminate\Support\Facades\File;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json_file = File::get('database/data/item-data.json'); // Get institution-data.json 
        DB::table('items')->delete(); // Delete all records from the institutions database table 
        $data = json_decode($json_file); // Convert the array of JSON objects in institution-data.json to a PHP variable
        foreach ($data as $obj) { // For each object (contains key/value pairs) in the PHP variable, create a new record in the institutions database table 
            Item::create(array( // Remember an Institution has three values - name, region and country. Make 
                                    // sure your JSON file matches the schema of your database table
                'item_name' => $obj->item_name,
                'item_quantity' => $obj->item_quantity,
                'item_price' => $obj->item_price
            ));
        } 
        //
    }
}
