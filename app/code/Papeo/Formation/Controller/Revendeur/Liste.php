<?php

namespace Papeo\Formation\Controller\Revendeur;

// Toute classe e controller Front Office doit hériter de la casllse ci-dessous
//class Liste extends Magento\Framework\App\Action\Action
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Papeo\Formation\Helper\Papeo;
use Papeo\Formation\Model\Revendeur;


class Liste extends Action
{

    /**
     * @var PageFactory
     */
    private $_pageFactory;
    /**
     * @var Papeo
     */
    private $_papeo;
    private \Papeo\Formation\Model\RevendeurFactory $_revendeurFactory;
    private \Papeo\Formation\Model\ResourceModel\Revendeur $_revendeurResourceModel;

    public function __construct(Context $context, PageFactory $pageFactory, Papeo $papeo,

                                \Papeo\Formation\Model\RevendeurFactory $revendeurFactory,
                                 \Papeo\Formation\Model\ResourceModel\Revendeur $revendeurResourceModel)
    {
        parent::__construct($context);
        $this->_pageFactory = $pageFactory;
        $this->_papeo = $papeo;
        $this->_revendeurFactory = $revendeurFactory;
        $this->_revendeurResourceModel = $revendeurResourceModel;
    }

    public function execute() {

        $hauteur = 20;
        $largeur = 10;
        $surface = 0;

        $surface = $this->_papeo->calculeSurface($hauteur,$largeur);

        //var_dump($surface);
        //exit;
     //je fais appel à la méthode create de la classe pageFactory


        $revendeur = $this->_revendeurFactory->create();
     //   $revendeurFactory->set
        // pas réussi avec setNom
        //$revendeur->setNom
        $revendeurFactoryTab = [];
        $revendeur->addData(
            [
                "Nom"=>"Sarah"
            ]);
        $revendeur->save();

        // autre méthode
        $revendeur->setData("Nom","Emma".rand(0,99));

      $this->_revendeurResourceModel->save($revendeur);
      //die("test4");

       return $this->_pageFactory->create("");

    }

    // Creer un formulaire de création d'un objet. Liste et Modif, supprim. "Controleur de post", methode Post
    //$block->getUrl
    // surcharge nom des catégories à traiter avec *



}
