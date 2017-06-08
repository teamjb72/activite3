<?php
// src/OC/PlatformBundle/DataFixtures/ORM/LoadAdvert.php

namespace OC\PlatformBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use OC\PlatformBundle\Entity\Skill;

class LoadSkill implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 10; $i++) {


            $advert = new Advert();
            $date = (new \DateTime());
            date_modify($date, '-40 day');

            $advert->setDate($date);

            $advert->setTitle('le titre de l\'annonce'.$i);

            $advert->setAuthor('auteur '.$i);

            $advert->setContent('texte de contenu annonce'.$i);

            $advert->setPublished('1');

            $advert->setUpdatedAt($date);


            $advert->setSlug('annonce'.$i);

            // On la persiste
            $manager->persist($advert);
        }
        // On déclenche l'enregistrement de toutes les compétences
        $manager->flush();
    }
}