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

        // Récupère la liste d'annonces ayant plus de x jours et moins d'une candidature affectée
        $listAdverts = $advertRepository->getOldAdverts($days);

        foreach ($listAdverts as $advert) {

            // Récupère les compétences recquises affectées à l'annonce
            // le filtre critère du FindBy est l'annonce
            $advertSkills = $advertSkillRepository->findBy(array('advert' => $advert));

            // Suppression de chaque compétence
            foreach ($advertSkills as $advertSkill) {
                $this->em->remove($advertSkill);
            }

            // Suppression de l'annonce
            $this->em->remove($advert);
          /* echo $advert->getTitle()."<br>;";*/
        }
       $this->em->flush();
    }
}