<?php

namespace Papeo\Formation2\Controller\Adminhtml\Ventes;

// Toute classe e controller Front Office doit hériter de la casllse ci-dessous
//class Liste extends Magento\Framework\App\Action\Action




class Ventes extends \Magento\Backend\App\Action
{


    public function execute() {


                $this->_view->loadLayout();
                $this->_view->renderLayout();


    }





}