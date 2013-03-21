<?php

namespace Sansthon\ProdBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * PerteRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PerteRepository extends EntityRepository {

    public function createPerteByArray($array) {
        if (!$array["type"] or !$array["etape"] or !$array["quantite"]) {
            return null;
        }
        $perte = new Perte();
        $perte->setPersonne($array["personne"]);
        $perte->setType($array["type"]);
        $perte->setEtape($array["etape"]);
        $perte->setQuantite($array["quantite"]);
        $perte->setCommentaire("casse usuelle ");
        $this->_em->persist($perte);
        $this->_em->flush();
        return $perte;
    }

    public function createPerteFromEtat($etat) {
        if (!$etat->getStocked()) {
            $perte = new Perte();
            $perte->setPersonne($etat->getPersonne());
            $perte->setType($etat->getType());
            $perte->setEtape($etat->getEtape());
            $perte->setQuantite($etat->getQuantite());
            $this->_em->persist($perte);
            $etat->finish(true);
            $this->_em->flush();
            return $perte;
        }else {
            return null;
        }
    }
}
