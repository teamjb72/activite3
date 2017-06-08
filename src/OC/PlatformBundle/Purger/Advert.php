<?php
// src/OC/PlatformBundle/Purger/Advert.php

namespace OC\PlatformBundle\Purger;

use Doctrine\ORM\EntityManagerInterface;

class Advert
{
    /**
     * Supprime annonce de plus de x jours et ayant moins d'une candidature affectée
     *
     * @param string $days
     * @return bool
     */

    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function purge($days)
    {



        $advertRepository      = $this->em->getRepository('OCPlatformBundle:Advert');
        $advertSkillRepository = $this->em->getRepository('OCPlatformBundle:AdvertSkill');

        $listAdverts = $advertRepository->getOldAdverts($days);

        foreach ($listAdverts as $advert) {

            $advertSkills = $advertSkillRepository->findBy(array('advert' => $advert));

            foreach ($advertSkills as $advertSkill) {
                $this->em->remove($advertSkill);
            }

            $this->em->remove($advert);
           echo $advert->getTitle()."<br>;";
        }

       $this->em->flush();

    }
}