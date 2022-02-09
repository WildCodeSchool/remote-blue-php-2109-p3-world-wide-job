<?php

namespace App\DataFixtures;

use App\Entity\Content;
use App\Services\Slugify;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ContentFixtures extends Fixture
{
    public const  LOREM = "Lorem ipsum dolor sit amet. Ut molestiae quae et recusandae veritatis est molestias 
      voluptas. Cum corrupti officiis internos consectetur ut natus libero et maiores temporibus sit consequatur 
      blanditiis et laborum molestiae. Sit neque optio quo praesentium enim et sapiente ducimus et expedita eaque sed 
      dolor saepe sed minima mollitia. Eum incidunt culpa in officiis quidem ut voluptatibus ducimus sit quae similique.
      Et dolorem dignissimos sed exercitationem voluptatem in libero ullam sit incidunt exercitationem et fugit labore.
      Qui illum dolore vel corporis repudiandae ut voluptatum repellendus et error laudantium vel consequuntur 
      reiciendis. Qui aliquid sapiente et dolorem illum non perferendis exercitationem. Et sint possimus aut saepe 
      arum et consectetur incidunt. Ab facilis consequatur qui quis harum est maiores minus est iusto galisum aut
      expedita unde ea illum magni et assumenda cupiditate? Ut omnis voluptatum ea debitis praesentium ut nihil 
      molestiae ea ipsam doloribus. Qui nemo fuga et ipsum perspiciatis sit facilis corporis ea fuga aliquam id 
      reprehenderit eaque! Ut galisum maxime rem totam omnis ex voluptas rerum non laborum repudiandae 
      et perferendis numquam?";

    private Slugify $slugify;


    public function __construct(Slugify $slugify)
    {
        $this->slugify = $slugify;
    }
    public function load(ObjectManager $manager)
    {

        $content = new Content();
        $content->setTitle('Mention légal');
        $content->setSlug($this->slugify->generate($content->getTitle()));
        $content->setBody(self::LOREM);
        $manager->persist($content);

        $content = new Content();
        $content->setTitle("Conditions d'utilisation");
        $content->setSlug($this->slugify->generate($content->getTitle()));
        $content->setBody(self::LOREM);
        $manager->persist($content);

        $content = new Content();
        $content->setTitle($this->slugify->generate("Crédits"));
        $content->setSlug($content->getTitle());
        $content->setBody(self::LOREM);
        $manager->persist($content);

        $manager->flush();
    }
}
