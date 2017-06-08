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

        $date = (new \DateTime());
        date_modify($date, '-'.$days.' day');
        echo "date reference pour la suppression : ".$date->format('Y-m-d H:i:s')."<br>";

        $advertRepository      = $this->em->getRepository('OCPlatformBundle:Advert');
        $advertSkillRepository = $this->em->getRepository('OCPlatformBundle:AdvertSkill');

        // On récupère les annonces à supprimer
        $listAdverts = $advertRepository->getOldAdverts($days);
        // On parcourt les annonces pour les supprimer effectivement
        foreach ($listAdverts as $advert) {

            $advertSkills = $advertSkillRepository->findBy(array('advert' => $advert));
            // Pour les supprimer toutes avant de pouvoir supprimer l'annonce elle-même
            /*foreach ($advertSkills as $advertSkill) {
                $this->em->remove($advertSkill);
            }*/
           /* // On peut maintenant supprimer l'annonce
            $this->em->remove($advert);*/
           echo $advert->getTitle()."<br>;";
        }
        // Et on n'oublie pas de faire un flush !
      /*  $this->em->flush();*/

    }
}