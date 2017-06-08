<?php
// src/OC/PlatformBundle/DataFixtures/ORM/LoadAdvert.php

namespace OC\PlatformBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use OC\PlatformBundle\Entity\Advert;
use OC\PlatformBundle\Entity\Image;
use OC\PlatformBundle\Entity\Category;
use OC\PlatformBundle\Entity\Skill;
use OC\PlatformBundle\Entity\AdvertSkill;

class LoadAdvert implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 10; $i++) {


            $advert = new Advert();
            $date = (new \DateTime());
            date_modify($date, '-100 day');

            $advert->setUpdatedAt($date);

            $advert->setTitle('le titre de l\'annonce'.$i);

            $advert->setAuthor('auteur '.$i);

            $advert->setContent('texte de contenu annonce'.$i);

            $advert->setPublished('1');

           /* $advert->setUpdatedAt($date);*/

            $image = new Image();
            $image->setUrl('http://sdz-upload.s3.amazonaws.com/prod/upload/job-de-reve.jpg');
            $image->setAlt('Job de rêve');

            // On lie l'image à l'annonce
            $advert->setImage($image);

            $category = new Category();
            $category->setName("Developpement Mars");
            $advert->addCategory($category);

            $advert->setSlug('annonce'.$i);

            $skill = new Skill ();
            $skill->setName("ruby");

            $advertskill = New AdvertSkill();
            $advertskill->setSkill($skill);
            $advertskill->setAdvert($advert);
            $advertskill->setLevel('facile');
            $manager->persist($skill);
            // On la persiste
            $manager->persist($advert);
            $manager->persist($advertskill);
        }
        // On déclenche l'enregistrement de toutes les compétences
        $manager->flush();
    }
}