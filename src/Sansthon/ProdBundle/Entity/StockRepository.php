<?php

namespace Sansthon\ProdBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Sansthon\ProdBundle\Entity\Stock;
/**
 * StockRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class StockRepository extends EntityRepository
{
  public function getByEtapeAndType($etape,$type){
    $stock= $this->findOneBy(
      array('etape' => $etape, 'type' => $type)
    );   
    if(!$stock){
      $stock = new Stock();
      $stock->setEtape($etape);
      $stock->setType($type);
      $stock->setValue(0);
      $this->_em->persist($stock);
      $this->_em->flush();
    }
    return $stock;
  }
  public function getByType($type){
    $stocks =$this->findBy(array('type' =>$type));
    $etapes = $this->_em->getRepository('SansthonProdBundle:Etape')->findAll();

    if(count($stocks) != count($etapes)){
      $stocks = array();
      foreach($etapes as $etape){
        array_push($stocks,$this->getbyEtapeAndType($etape,$type));
      }
    }
    return $stocks;
  }
}
