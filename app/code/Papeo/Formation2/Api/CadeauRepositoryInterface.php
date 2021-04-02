<?php


namespace Papeo\Formation2\Api;

interface CadeauRepositoryInterface
{
//    /** Renvoie un objet cadeau par son paramètre
////     * @param $id
////     * @return mixed
////     */
////    public function getById($id);
////
////    /** Renvoie la liste des cadeaux
////     * @return mixed
////     */
////    public function getList();
////
////    /** Supprimer un cadeau par son id
////     * @param $id
////     * @return mixed
////     */
////    public function deleteById($id);

    /**
     * @param float $hauteur
     * @param float $largeur
     * @return mixed
     */

public function calculeSurface($hauteur,$largeur);

}
