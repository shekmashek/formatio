<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\FormateurInterne;

$factory->define(FormateurInterne::class, function (Faker $faker) {
    return [
        'nom_formateur' => 'Formateur Interne',
        'prenom_formateur' => $faker->name,
        'mail_formateur' => 'formateur_interne01@test.com',
        'numero_formateur' => $faker->phoneNumber,
        'photos' => null,
        'genre' => $faker->randomElement(['M', 'F']),
        'date_naissance' => $faker->dateTimeBetween('-60 years', '-20 years'),
        'adresse' => $faker->address,
        'cin' => $faker->randomNumber(8),
        'specialite' => $faker->randomElement(['Développeur', 'Designer', 'Rédacteur', 'Webmaster']),
        'niveau' => $faker->randomElement(['Bac+5', 'Bac+6', 'Bac+7', 'Bac+8', 'Bac+9', 'Bac+10']),
        'activiter' => 1,
        'user_id' => function () {
            return factory(App\User::class)->create()->id;
        },
        'entreprise_id' => 1,
        'url_photo' => $faker->imageUrl(640, 480, 'people'),
    
    ];
});
