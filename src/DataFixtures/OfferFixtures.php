<?php

namespace App\DataFixtures;

use App\Entity\Offer;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class OfferFixtures extends Fixture implements DependentFixtureInterface
{
    public const OFFER = [
        'Offre de stage - Achats',
        'Alternance - Développement Web',
        'Offre de stage - Commerce',
        'Offre de stage - Marketing',
        'Alternance - Communication',
    ];

    public function load(ObjectManager $manager): void
    {
        $maxOffer = 3;
        $counter = -1;
        for ($i = 0; $i < $maxOffer; $i++) {
            foreach (self::OFFER as $name) {
                $counter++;
                $offer = new Offer();
                $offer->setName($name)
                    ->setCity('Lyon')
                    ->setContractType(rand(1, 3))
                    ->setDuration(rand(1, 6))
                    ->setShortDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit, 
                    sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.')
                    ->setDateOfPublication(new DateTime())
                    ->setLongDescription('
                    Lorem ipsum dolor sit amet. Ad voluptatem neque et 
                    maxime distinctio et voluptate fugiat quo voluptas
                    aspernatur. Et corporis nihil vel vero nihil At quia 
                    modi sit provident libero in dolores aperiam.
                    Hic eius eveniet ex sunt consequuntur aut 
                    exercitationem delectus et perferendis internos et iure harum
                    est nesciunt rerum ea perspiciatis rerum. 
                    Est error blanditiis est unde delectus et nihil voluptate
                    sed amet iure? Vel nisi inventore a iste consequatur 
                    sed officia dolorum et autem ratione ea iure minus et dolorem 
                    laboriosam qui consequatur labore.
                    Et alias tenetur ad molestiae ducimus in sequi voluptates et 
                    fuga autem et laboriosam error sed illum 
                    fugit quo excepturi mollitia. 
                    A eaque natus ut veritatis quidem ea deleniti eius et voluptas 
                    illo id velit iusto est perferendis 
                    Quis. Ea atque recusandae ab earum omnis id sint laboriosam 
                    est voluptatem ullam. Qui numquam tempora 
                    et minus delectus et repellat quia ea sint assumenda.')
                    ->setFieldOfActivity(rand(1, 4))
                    ->setDateIn(new DateTime('2021-01-12'))
                    ->setWage(rand(600, 1600))
                    ->setTutor('Mathieu Dupont')
                    ->setDrivingLicence(true)
                    ->setCompany($this->getReference('company_' . rand(0, 4)));
                $this->addReference('offer_' . $counter, $offer);
                $manager->persist($offer);
            }
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            CompanyFixtures::class
        ];
    }
}
