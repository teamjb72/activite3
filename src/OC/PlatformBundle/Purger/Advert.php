<?php
// src/OC/PlatformBundle/Purger/Advert.php

namespace OC\PlatformBundle\Purger;

use OC\PlatformBundle\Entity\AdvertRepository;

class Advert
{
    /**
     * Supprime annonce de plus de x jours et ayant moins d'une candidature affectée
     *
     * @param string $days
     * @return bool
     */


    public function __construct()
    {

    }

    public function purge($days)
    {

        $repository = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('OCPlatformBundle:Advert')
        ;

        $listAdverts = $repository->getOldAdverts();

        return strlen($days) < "3";

    }
}