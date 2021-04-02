<?php


namespace Papeo\ApiRealisaprint\Helper;


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
        \Magento\Sales\Api\OrderRepositoryInterface $orderRepository
    ) {
        $this->_shipmentTrackFactory = $shipmentTrackFactory;
        $this->_shipmentFactory = $shipmentFactory;
        $this->_transactionFactory = $transactionFactory;
        $this->_orderRepository = $orderRepository;
    }

    /**
     * @param int $orderId
     * @param string $trackingNumber
     * @return \Magento\Sales\Model\Shipment $shipment
     */
    public function createShipment($orderId, $trackingNumber)
    {
        try {
            $order = $this->_orderRepository->get($orderId);
            if ($order){
                $data = array(array(
                    'carrier_code' => $order->getShippingMethod(),
                    'title' => $order->getShippingDescription(),
                    'number' => $trackingNumber,
                ));
                $shipment = $this->prepareShipment($order, $data);
                if ($shipment) {
                    $order->setIsInProcess(true);
                    $order->addStatusHistoryComment('Automatically SHIPPED', false);
                    $transactionSave =  $this->_transactionFactory->create()->addObject($shipment)->addObject($shipment->getOrder());
                    $transactionSave->save();
                }
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
    public function prepareShipment($order, $track)
    {
        $shipment = $this->_shipmentFactory->create(
            $order,
            $this->prepareShipmentItems($order),
            $track
        );
        return $shipment->getTotalQty() ? $shipment->register() : false;
    }

    /**
     * @param $order \Magento\Sales\Model\Order
     * @return array
     */
    public function prepareShipmentItems($order)
    {
        $items = [];

        foreach($order->getAllItems() as $item) {
            $items[$item->getItemId()] = $item->getQtyOrdered();
        }
        return $items;
    }
}
