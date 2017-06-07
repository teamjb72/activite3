<?php
// src/OC/PlatformBundle/Purger/Advert.php

namespace OC\PlatformBundle\Purger;

use OC\PlatformBundle\Entity\AdvertRepository;
use Doctrine\ORM\EntityManagerInterface;

class Advert
{
    /**
     * Supprime annonce de plus de x jours et ayant moins d'une candidature affectée
     *
     * @param string $days
     * @return bool
     */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->ademvert = $em;
    }

    public function purge($days)
    {
        $em = $this->get('doctrine')->getEntityManager();
        $repository = $em
            ->getDoctrine()
            ->getManager()
            ->getRepository('OCPlatformBundle:Advert')
        ;

        $listAdverts = $repository->getOldAdverts();

        return strlen($days) < "3";

    }
}