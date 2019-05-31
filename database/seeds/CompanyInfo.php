<?php

use Illuminate\Database\Seeder;

class CompanyInfo extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $companyInfo=[
            [
                'company_name'=>'Far East IT Solutions Ltd',
                'company_phone'=>'01852665521',
                'company_email'=>'info@feits.co',
                'company_address'=>'House #51, Road #18, Sector #11 
                Uttara, Dhaka-1230',

            ]
        ];
        DB::table('tb_company_information')->insert($companyInfo);
    }
}
