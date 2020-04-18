<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public static function readable_random_string($length = 6)
    {
        $string     = '';
        $vowels     = array("a","e","i","o","u");
        $consonants = array(
            'b', 'c', 'd', 'f', 'g', 'h', 'j', 'k', 'l', 'm',
            'n', 'p', 'r', 's', 't', 'v', 'w', 'x', 'y', 'z'
        );

        // Seed it
        srand((double) microtime() * 1000000);

        $max = $length/2;
        for ($i = 1; $i <= $max; $i++)
        {
            $string .= $consonants[rand(0,19)];
            $string .= $vowels[rand(0,4)];
        }

        return $string;
    }

    /**
     * Seed the application's database.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        factory(App\User::class, 200)->create();
        factory(App\Quiz::class, 200)->create();
        factory(App\Tag::class, 80)->create();
        factory(App\Question::class, 1000)->create();
        factory(App\Answer::class, 200)->create();

        for ($i = 0; $i < App\User::all()->count()*2; $i++) {
            DB::table('ratings')->insert(
                [
                    'user_id' => App\User::all()->random()->id,
                    'quiz_id' => App\Quiz::all()->random()->id,
                    'rating' => random_int(0, 5)
                ]
            );
        }

        for ($i = 0; $i < App\User::all()->count()*2; $i++) {
            DB::table('quiz_tag')->insert(
                [
                    'tag_id' => App\Tag::all()->random()->id,
                    'quiz_id' => App\Quiz::all()->random()->id
                ]
            );
        }
    }
}
