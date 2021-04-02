<?php


namespace Papeo\Formation\Block\Revendeur;


use Magento\Catalog\Model\CategoryRepository;
use Magento\Catalog\Model\CategoryList;
use Magento\Catalog\Model\ProductRepository;
use Magento\Customer\Model\Customer;
use Magento\Framework\Api\Search\FilterGroupBuilder;
use Magento\Framework\Api\Search\SearchCriteria;
use Magento\Framework\View\Element\Template;
use Magento\Sales\Model\OrderRepository;
use Magento\Catalog\Model\ProductFactory;
use Magento\Customer\Model\CustomerFactory;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\AbstractSimpleObject;
use Magento\Framework\Api\FilterBuilder;
use Magento\Customer\Model\ResourceModel\Customer\Collection;
use Magento\Customer\Model\ResourceModel\Customer\CollectionFactory;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Papeo\Formation\Model\ResourceModel\Revendeur;




class Liste extends Template
{
//$context<-genere le construct de la classe parent

    /**
     *
     * /**
     * @var SearchCriteria
     */
    private $_searchCriteria;
    /**
     * @var ProductRepository
     */
    private $_productRepository;
    /**
     * @var OrderRepository
     */
    private $_orderRepository;
    /**
     * @var CategoryRepository
     */
    private $_categoryRepository;
    /**
     * @var SearchCriteriaBuilder
     */
    private $_searchCriteriaBuilder;
    /**
     * @var ProductFactory
     */
    private $_productFactory;
    /**
     * @var CustomerFactory
     */
    private $_customerFactory;
    /**
     * @var Customer
     */
    private $_customer;
    /**
     * @var FilterBuilder
     */
    private FilterBuilder $_filterBuilder;
    /**
     * @var FilterGroupBuilder
     */
    private FilterGroupBuilder $_filterGroupBuilder;
    /**
     * @var CollectionFactory
     */
    private CollectionFactory $_customerCollectionFactory;
    /**
     * @var Revendeur
     */
    private Revendeur $_revendeur;
    private $_objectManager;

    /**
     * @var \Papeo\Formation\Model\ResourceModel\Revendeur\CollectionFactory
     */
    private $_revendeurCollectionFactory;


    public function __construct(Template\Context $context, ProductRepository $productRepository,
                                \Papeo\Formation\Model\ResourceModel\Revendeur\CollectionFactory $revendeurCollectionFactory,
                                CollectionFactory $customerCollectionFactory, Revendeur $revendeur,Customer $customer, FilterBuilder $filterBuilder, FilterGroupBuilder $filterGroupBuilder,CustomerFactory $customerFactory, ProductFactory $productFactory, CategoryList $categoryRepository, SearchCriteriaBuilder $searchCriteriaBuilder, OrderRepository $orderRepository, SearchCriteria $searchCriteria, array $data = [])
    {
        $this->_productRepository = $productRepository;
        $this->_orderRepository = $orderRepository;
        $this->_categoryRepository = $categoryRepository;
        $this->_searchCriteria = $searchCriteria;
        $this->_searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->_productFactory = $productFactory;
        $this->_customerFactory = $customerFactory;
        $this->_customer = $customer;
        $this->_filterBuilder = $filterBuilder;
        $this->_filterGroupBuilder = $filterGroupBuilder;
        $this->_customerCollectionFactory = $customerCollectionFactory;
        $this->_revendeur = $revendeur;
        $this->_revendeurCollectionFactory = $revendeurCollectionFactory;
        $this->_objectManager = \Magento\Framework\App\ObjectManager::getInstance();




        parent::__construct($context, $data);

    }

    /**
     * public function afficheMonTexte() {
     * $surface = $this->_papeoHelper->calculeSurface(10,38);
     * $texte = "Affiche mon texte depuis la faction afficheMonTexte". $surface;
     * return $texte;
     * }
     *
     * public function getMonProduit($sku) {
     *
     * $monproduit = $this->_productRepository->get($sku);
     * return $monproduit;
     *
     *
     * }*/

//Exercice nombre de fois où ce produit a été commandé.
// ne pas utiliser les repository

    public function getMesProduits()
    {
        $searchCriteria = $this->_searchCriteriaBuilder->create();
        $searchCriteria->setPageSize(20);
        //Pas réussi
        // $searchCriteriaBuilder = $this->_searchCriteriaBuilder->addFilter("sku","WSH07");

        $filtre1 = $this->_filterBuilder->setField("name")
            ->setValue("%Bag%")
            ->setConditionType("like")
            ->create();

        $filterGroup1 = $this->_filterGroupBuilder->addFilter($filtre1)
            ->create();
        $searchCriteria->setFilterGroups([$filterGroup1]);

        //criteria;
        $mesproduits = $this->_productRepository->getList($searchCriteria);
     //   var_dump($mesproduits->setItems(""));
       // die;

        //var_dump(get_class($mesproduits));


        return $mesproduits->getItems();


    }

    public function getMesCommandes()
    {
        $searchCriteria = $this->_searchCriteria;
        $mesCommandes = $this->_orderRepository->getList($searchCriteria);
        return $mesCommandes->getItems();


    }

// Pas réussi à faire avec le CategoryRepository
    public function getMesCategories()
    {
        $searchCriteria = $this->_searchCriteria;
        $mesCategories = $this->_categoryRepository->getList($searchCriteria);
        return $mesCategories->getItems();


    }

    public function getMesClients()
    {
       // $searchCriteria = $this->_searchCriteria;
        // ancienne méthode
      // $mesClients = $this->_customer->getCollection();

       $mesClients = $this->_customerCollectionFactory->create();
        // ancienne méthode
        //return $mesClients->getItems();
        //nouvelle méthode
         return $mesClients;
    }



    public function getMesRevendeurs() {

       // $mesrevendeurs = $this->_objectManager->create(Revendeur::class);

       //$mesRevendeurs = $this->_objectManager->create(\Papeo\Formation\Model\Revendeur::class);
       // $mesRevendeurs = ["toto"=>"titi","tara","tete"];

        //return $this->_objectManager->get(\Papeo\Formation\Model\Revendeur::class);

        return $this->_revendeurCollectionFactory->create();

        //$revendeur = $this->_objectManager->create(\Papeo\Formation\Model\Revendeur::class);
        //$revendeur = $this->getData();

    }

}

