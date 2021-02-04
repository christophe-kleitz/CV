<?php


namespace App\DataFixtures;


use App\Entity\Skills;
use App\Service\Slugify;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SkillsFixtures extends Fixture
{
    const SKILLS = [
        'Soft Skills' => [
            'Travail d\'équipe',
            'Sociabilité',
            'Ecoute',
            'Persévérance'
        ],
        'Hard Skills' => [
            'HTML/CSS',
            'BootStrap',
            'PHP/Symfony',
            'JS',
            'MySQL',
            'GitHub',
            'Agile: SCRUM',
        ]
    ];

    private $slugify;

    public function __construct(Slugify $slugify)
    {
        $this->slugify = $slugify;
    }

    public function load(ObjectManager $manager)
    {
        $slugify = new Slugify();
        $i = 0;
        foreach (self::SKILLS as $category => $skills) {
            foreach ($skills as $name) {
                $skill = new Skills();
                $skill->setName($name);
                $skill->setCategory($category);
                $slug = $slugify->generate($skill->getName());
                $skill->setSlug($slug);
                $manager->persist($skill);
                $i++;
            }
        }
        $manager->flush();
    }
}
