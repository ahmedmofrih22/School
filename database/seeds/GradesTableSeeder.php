<?php

use App\Models\Grade;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GradesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('grades')->delete();
        $Grade = [
            ['en' => 'Primary stage', 'ar' => 'المرحله الابتدائيه'],
            ['en' => 'middle School', 'ar' => 'المرحله الاعداديه'],
            ['en' => 'High school', 'ar' => 'المرحلة الثانوية'],


        ];
        foreach ($Grade as $S) {
            Grade::create([
                'Name' => $S,
                'Notes' => '',

            ]);
        }
    }
}
