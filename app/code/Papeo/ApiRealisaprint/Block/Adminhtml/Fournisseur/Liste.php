<?php


namespace Papeo\ApiRealisaprint\Block\Adminhtml\Fournisseur;

use Magento\Framework\View\Element\Template;
use Magento\Sales\Model\Order\ItemRepository;
use Papeo\ApiRealisaprint\Model\ResourceModel\Fournisseur;
use Magento\Sales\Model\OrderRepository;
use Magento\Sales\Model\Order;




class Liste extends \Magento\Framework\View\Element\Template
{

    /**
     * @var \Papeo\ApiRealisaprint\Model\ResourceModel\Item\Collection
     */
    private \Papeo\ApiRealisaprint\Model\ResourceModel\Item\Collection $_itemCollectionFactory;
    protected ItemRepository $_itemRepository;
    /**
     * @var Fournisseur\CollectionFactory
     */
    private Fournisseur\CollectionFactory $_fournisseurCollectionFactory;
    private \Magento\Framework\Api\SearchCriteria $_searchCriteria;
    /**
     * @var OrderRepository
     */
    private OrderRepository $_orderRepository;
    /**
     * @var Order
     */
    private Order $_order;


    public function __construct(Template\Context $context, array $data = [],
                                \Papeo\ApiRealisaprint\Model\ResourceModel\Fournisseur\CollectionFactory $fournisseurCollectionFactory,
                                \Magento\Framework\Api\SearchCriteria $searchCriteria,
                                Order $order,
                                OrderRepository $orderRepository,
                                ItemRepository $itemRepository)
{
    $this->_fournisseurCollectionFactory = $fournisseurCollectionFactory;
    $this->_orderRepository = $orderRepository;
    $this->_searchCriteria = $searchCriteria;
    $this->_itemRepository = $itemRepository;
    $this->_order = $order;
    parent::__construct($context, $data);
}
    public function getFournisseurs()
    {
        $Fournisseur = $this->_fournisseurCollectionFactory->create();
        return $Fournisseur;

    }


    public function getdefautFournisseur($id)
    {
      $order = $this->_itemRepository->get($id);

      return $order->getData("id_fournisseur");

    }

    public function getItemCommande($id)
    {
        $searchCriteria = $this->_searchCriteria;
        $order = $this->_orderRepository->get($id);
        //return $order->getData("total_item_count");
        return count($order->getAllVisibleItems());


    }

    public function getdefautCdeFournisseur($id)
    {
        $order = $this->_itemRepository->get($id);

        return $order->getData("numero_commande_fournisseur");


    }

    public function getTransporteur($id)
    {
        $order = $this->_itemRepository->get($id);

        return $order->getData("url_transporteur");


    }







}
