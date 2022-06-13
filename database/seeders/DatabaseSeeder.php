<?php

namespace Database\Seeders;

use App\Models\Language;
use App\Models\Profile;
use App\Models\Type;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $data = new Language();
        $data->language = 'Русский';
        $data->lang_code = 'ru';
        $data->save();
        $data = new Language();
        $data->language = 'English';
        $data->lang_code = 'en';
        $data->save();
//        $data = new Language();
//        $data->language = 'Deutsch';
//        $data->lang_code = 'de';
//        $data->save();
//        $data = new Language();
//        $data->language = 'Español';
//        $data->lang_code = 'es';
//        $data->save();

        $data = new Type();
        $data->type = 'Слова';
        $data->save();
        $data = new Type();
        $data->type = 'Фразы';
        $data->save();
        $data = new Type();
        $data->type = 'Тексты';
        $data->save();
        $data = new Type();
        $data->type = 'Книга';
        $data->save();

//        \App\Models\User::factory(50)->create();
        \App\Models\Profile::factory(50)->create();
//        \App\Models\Dictionary::factory(200)->create();
//        \App\Models\Favorite::factory(400)->create();
//        \App\Models\Game::factory(400)->create();
//        \App\Models\Comment::factory(400)->create();
//        \App\Models\Grade::factory(400)->create();
//
        $user = User::create([
            'name' => 'ArtemBashorin',
            'email' => 'mar.adamson.29@gmail.com',
            'password' => Hash::make('qwaszxcv1'),
            'email_verified_at' => now(),
            'role' => 'admin'
        ]);
        Profile::create([
            'user_id' => $user->id,
        ]);
    }
}
