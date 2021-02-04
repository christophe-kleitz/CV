<?php


namespace App\DataFixtures;


use App\Entity\Project;
use App\Service\Slugify;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProjectFixtures extends Fixture
{
    private $slugify;

    public function __construct(Slugify $slugify)
    {
        $this->slugify = $slugify;
    }

    const PROJECT = [
        'CV fictif' => [
            'url' => 'https://github.com/christophe-kleitz/CV_John_Wick',
            'start' => '29-09-2020',
            'end' => '09-10-2020',
            'description' => 'Réalisation d\'un CV en ligne pour un personnage fictif en équipe de 5',
            'image' => 'https://gritdaily.com/wp-content/uploads/2020/08/John-Wick.jpg',
        ],
        'Hackathon' => [
            'url' => 'https://github.com/christophe-kleitz/Hackathon/tree/master',
            'start' => '19-11-2020',
            'end' => '20-11-2020',
            'description' => 'Création d\'un site de vote en ligne à l\'époque de la révolution.
            Travail en équipe de 5 sur 24h.
            Consommation d\'une API du gouvernement (OpenData Assemblée Nationale)',
            'image' => 'https://github.com/christophe-kleitz/Hackathon/blob/Chris_dev/public/assets/images/logo.png?raw=true',
        ],
        'Projet fictif - Stras\'Gîte' => [
            'url' => 'https://github.com/christophe-kleitz/Stras-Gite/tree/master',
            'start' => '19-10-2020',
            'end' => '27-11-2020',
            'description' => 'Réalisation d\'un site de réservation pour un
                gîte strasbourgeois fictif.
                Travail en équipe de 3 sur 5 semaines',
            'image' => 'https://github.com/christophe-kleitz/Stras-Gite/blob/master/public/assets/images/general/logo.png?raw=true',
        ],
        'Projet client - Heaven Food' => [
            'url' => 'www.heavenfood.com',
            'start' => '30-11-2020',
            'end' => '12-02-2021',
            'description' => 'Création d\'un site pour un restaurant de tacos français situé sur Sélestat.
            Le client a demandé un affichage de tous les produits qu\'il propose à la vente, ainsi que la création
            d\'une page \'Crée ton tacos\' permettant de personnaliser son tacos.',
            'image' => 'https://cdn.discordapp.com/attachments/760483758460764192/806810854875463700/mighty_meaty__heavenly_smaller_v3_1.png',
        ],
        'Heroes Raid' => [
            'url' => 'https://github.com/JeffNys/hackathon2-team4',
            'start' => '13-01-2021',
            'end' => '15-01-2021',
            'description' => 'Création d\'un mini-jeu utilisant les données de l\'API SuperHero',
            'image' => 'https://images-na.ssl-images-amazon.com/images/I/81aPiwUuMIL._AC_UX569_.jpg'
        ]
    ];

    public function load(ObjectManager $manager)
    {
        $slugify = new Slugify();
        $i =0;
        foreach (self::PROJECT as $title => $data)
        {
            $project = new Project();
            $project->setName($title);
            $slug = $slugify->generate($project->getName());
            $project->setSlug($slug);
            $start = DateTime::createFromFormat('d-m-Y', $data['start']);
            $project->setDateStart($start);
            $end = DateTime::createFromFormat('d-m-Y', $data['end']);
            $project->setDateEnd($end);
            $project->setDescription($data['description']);
            $project->setImage($data['image']);
            $project->setUrl($data['url']);
            $manager->persist($project);
            $i++;
        }
        $manager->flush();
    }
}
