<?php


namespace App\DataFixtures;


use App\Entity\Formation;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class FormationFixtures extends Fixture
{
    const FORMATION = [
        'Université de Strasbourg' => [
            'start' => '04-09-2012',
            'end' => '15-06-2014',
            'description' => 'Faculté de Maths-Info, 2 premières années'
        ],
        'Wild Code School' => [
            'start' => '14-09-2020',
            'end' => '12-02-2021',
            'description' => 'Développeur Web/Mobile:
            Apprentissage de PHP / Symfony, JS, MySQL
            Mise en pratique de la Méthodologie SCRUM
            Réalisation projets fictifs et clients
            Initiation travail et apprentissage en remote',
        ]
    ];

    public function load(ObjectManager $manager)
    {
        $i = 0;
        foreach (self::FORMATION as $title => $data)
        {
            $formation = new Formation();
            $formation->setName($title);
            $start = DateTime::createFromFormat('d-m-Y', $data['start']);
            $formation->setStart($start);
            $end = DateTime::createFromFormat('d-m-Y', $data['end']);
            $formation->setEnd($end);
            $formation->setDescription($data['description']);
            $manager->persist($formation);
            $i++;
        }
        $manager->flush();
    }
}
