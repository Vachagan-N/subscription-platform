<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WebsitesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('websites')->truncate();
        $websitesData = $this->getWebsites();
        DB::table('websites')->insert($websitesData);
    }

    public function getWebsites()
    {
        return [
            [
                'name' => 'Facebook',
                'url' => 'https://www.facebook.com/',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'YouTube',
                'url' => 'https://www.youtube.com/',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'Instagram',
                'url' => 'https://www.instagram.com/',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];
    }
}
