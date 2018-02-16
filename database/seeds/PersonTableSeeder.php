<?php

use Illuminate\Database\Seeder;

class PersonTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('people')->insert([
            "name" => "Muchus Testus",
            "birth_place" => "Moltava",
            "birth_date" => "2012-05-04",
            "trivia" => "Lite text här",
        ]);

        DB::table('people')->insert([
            "name" => "Jonas Donas",
            "birth_place" => "Moscow",
            "birth_date" => "2012-05-04",
            "trivia" => "Något annat står här",
        ]);

        DB::table('people')->insert([
            "name" => "Nicke Nyfiken",
            "birth_place" => "Stockholm",
            "birth_date" => "2012-05-04",
            "trivia" => "Han är en väldigt nyfiken liten apa",
        ]);

        DB::table('people')->insert([
            "name" => "Gneten Smeten",
            "birth_place" => "New York",
            "birth_date" => "2012-05-04",
            "trivia" => "Kanske inte helt korrekt plats men ändå kul",
        ]);
    }
}
