<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AboutUs;

class AboutUsSeeder extends Seeder
{
    public function run()
    {
        AboutUs::create([
            'company_name' => 'Notre Club de Sport',
            'description' => 'Bienvenue dans notre club de sport, où l\'excellence et la passion se rencontrent. Nous nous engageons à fournir un environnement motivant et professionnel pour tous nos membres.',
            'mission' => 'Notre mission est d\'inspirer et d\'encourager une vie saine et active à travers des programmes sportifs innovants et accessibles à tous.',
            'vision' => 'Devenir le club de sport de référence en offrant des services de qualité supérieure et en créant une communauté dynamique et inclusive.',
            'address' => '123 Rue du Sport, Ville',
            'phone' => '+213 123 456 789',
            'email' => 'contact@clubsport.com',
            'facebook_url' => 'https://facebook.com/clubsport',
            'instagram_url' => 'https://instagram.com/clubsport',
            'whatsapp' => '+213123456789',
            'map_link' => 'https://maps.google.com/?q=123+Rue+du+Sport'
        ]);
    }
}
