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


        $repository = $this->em
            ->getRepository('OCPlatformBundle:Advert')
        ;

        $listAdverts = $repository->getOldAdverts($days);
        var_dump($listAdverts) ;
        return $listAdverts;

        /*return strlen($days) < "3";*/

    }
}