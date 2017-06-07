<?php
// src/OC/PlatformBundle/Purger/Advert.php

namespace OC\PlatformBundle\Purger;

use OC\PlatformBundle\Entity\AdvertRepository;
use Doctrine\ORM\EntityRepository;


class Advert
{
    /**
     * Supprime annonce de plus de x jours et ayant moins d'une candidature affectée
     *
     * @param string $days
     * @return bool
     */
    private $advert;

    public function __construct(EntityRepository $advert)
    {
        $this->advert = $advert;
    }

    public function purge($days)
    {

        $repository = $this->advert
            ->getDoctrine()
            ->getManager()
            ->getRepository('OCPlatformBundle:Advert')
        ;

        $listAdverts = $repository->getOldAdverts();

        return strlen($days) < "3";

    }
}