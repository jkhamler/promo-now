<?php

use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $englishLanguage = new \App\Models\Language();

        $englishLanguage->name = 'English';
        $englishLanguage->iso_code = 'EN';

        $englishLanguage->save();

        $dutchLanguage = new \App\Models\Language();

        $dutchLanguage->name = 'Dutch';
        $dutchLanguage->iso_code = 'NL';

        $dutchLanguage->save();

        $germanLanguage = new \App\Models\Language();

        $germanLanguage->name = 'German';
        $germanLanguage->iso_code = 'DE';

        $germanLanguage->save();

        $frenchLanguage = new \App\Models\Language();

        $frenchLanguage->name = 'French';
        $frenchLanguage->iso_code = 'FR';

        $frenchLanguage->save();

        $crikey = new \App\Models\Profanity();
        $crikey->language_id = $englishLanguage->id;
        $crikey->profanity = 'Crikey';
        $crikey->save();

        $splendid = new \App\Models\Profanity();
        $splendid->language_id = $englishLanguage->id;
        $splendid->profanity = 'Splendid';
        $splendid->save();

        $scheise = new \App\Models\Profanity();
        $scheise->language_id = $germanLanguage->id;
        $scheise->profanity = 'ShießE';
        $scheise->save();

        $sacreBleu = new \App\Models\Profanity();
        $sacreBleu->language_id = $frenchLanguage->id;
        $sacreBleu->profanity = 'Sacre Bleu!';
        $sacreBleu->save();

        $hoer = new \App\Models\Profanity();
        $hoer->language_id = $dutchLanguage->id;
        $hoer->profanity = 'Hoer';
        $hoer->save();

    }
}
