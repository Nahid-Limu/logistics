<?php

use Illuminate\Database\Seeder;

class DimensionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=[
            [
                'weight'=>'up to 1',
                'size'=>'34 x 18 x 10',
            ],
            [
                'weight'=>'up to 2',
                'size'=>'34 x 25 x 12',
            ],
            [
                'weight'=>'up to 3',
                'size'=>'34 x 32 x 14',
            ],
            [
                'weight'=>'up to 5',
                'size'=>'40 x 40 x 23',
            ],
            [
                'weight'=>'up to 7',
                'size'=>'40 x 40 x 32',
            ],
            [
                'weight'=>'up to 12',
                'size'=>'60 x 60 x 38',
            ],
            [
                'weight'=>'up to 18',
                'size'=>'62 x 62 x 50',
            ],
            [
                'weight'=>'up to 25',
                'size'=>'90 x 90 x 60',
            ],
        ];
        DB::table('tbdimension')->insert($data);
    }
}
