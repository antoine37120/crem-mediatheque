<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GlobalSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $setting = \App\Models\GlobalSetting::firstOrCreate(['key' => 'footer_mentions']);

        // Optional: set default values if needed, but better to leave empty or let admin set it.
        // If we want to force default values:
        /*
        foreach (['en', 'fr'] as $locale) {
            if (!$setting->translate($locale)) {
                $setting->translateOrNew($locale)->value = '';
                $setting->save();
            }
        }
        */
    }
}
