<?php


namespace Papeo\ApiRealisaprint\Helper;

use Magento\Sales\Model\Order\ItemRepository;
use Magento\Backend\Model\Auth\Session;




class ApiExpedition
{

    /**
     * @var \Magento\Sales\Model\Order\Shipment\TrackFactory
     */
    protected $_shipmentTrackFactory;

    /**
     * @var \Magento\Sales\Model\Order\ShipmentFactory
     */
    protected $_shipmentFactory;

    /**
     * @var \Magento\Framework\DB\TransactionFactory
     */
    protected $_transactionFactory;

    /**
     * @var \Magento\Sales\Api\OrderRepositoryInterface
     */
    protected $_orderRepository;

    /**
     * @param \Magento\Sales\Model\Order\Shipment\TrackFactory $shipmentTrackFactory
     * @param \Magento\Sales\Model\Order\ShipmentFactory $shipmentFactory
     * @param \Magento\Framework\DB\TransactionFactory $transactionFactory
     * @param \Magento\Sales\Api\OrderRepositoryInterface $orderRepository
     */
    public function __construct(
        \Magento\Sales\Model\Order\Shipment\TrackFactory $shipmentTrackFactory,
        \Magento\Sales\Model\Order\ShipmentFactory $shipmentFactory,
        \Magento\Framework\DB\TransactionFactory $transactionFactory,
        \Magento\Sales\Api\OrderRepositoryInterface $orderRepository,
        ItemRepository $itemRepository,
        \Magento\Backend\Model\Auth\Session $autSession,
        \Magento\Sales\Model\Order\Shipment\NotifierInterface $notierEmail)
    {
        $this->_shipmentTrackFactory = $shipmentTrackFactory;
        $this->_shipmentFactory = $shipmentFactory;
        $this->_transactionFactory = $transactionFactory;
        $this->_orderRepository = $orderRepository;
        $this->_itemRepository = $itemRepository;
        $this->_autSession = $autSession;
        $this->_notierEmail = $notierEmail;
    }

    /**
     * @param \Magento\Sales\Model\Order\Item\ $idItem
     * @param string $trackingNumber
     * @return \Magento\Sales\Model\Shipment $shipment
     */
    public function createShipment(\Magento\Sales\Model\Order\Item $item, $trackingNumber, $nomTransporteur)

    {

        try {

            $order = $item->getOrder();

            if ($order) {
                $data = array(array(
                    'carrier_code' => $order->getShippingMethod(),
                    'title' => $nomTransporteur,
                    'number' => $trackingNumber,

                ));
                $shipment = $this->prepareShipment($order, $data, $item);


                if ($shipment) {
                    $order->setIsInProcess(true);
              //     $order->addStatusHistoryComment('Automatically Envoyé Item'.$item->getName()."par ". $this->_autSession->getUser()->getName(), false);
                    $transactionSave = $this->_transactionFactory->create()->addObject($shipment)->addObject($shipment->getOrder());
                    $transactionSave->save();
                    $this->_notierEmail->notify($order,$shipment);
                }
                //echo "l item est ". $item->getItemId();
                //exit("yy");
                return $shipment;
            }
        } catch (\Exception $e) {
            throw new \Magento\Framework\Exception\LocalizedException(
                __($e->getMessage())
            );
        }
    }

    /**
     * @param $order \Magento\Sales\Model\Order
     * @param $track array
     * @return $this
     */
    public function prepareShipment($order, $track, \Magento\Sales\Model\Order\Item $item)
    {

        $articleAExpedier = [];
        $articleAExpedier[$item->getId()] = $item->getQtyOrdered();

        $shipment = $this->_shipmentFactory->create($order,$articleAExpedier,$track);
        return $shipment->getTotalQty() ? $shipment->register() : false;
    }

    /**
     * @param $order \Magento\Sales\Model\Order
     * @return array
     */

}
