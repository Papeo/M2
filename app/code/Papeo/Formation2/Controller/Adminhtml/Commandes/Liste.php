<?php

namespace Papeo\Formation2\Controller\Adminhtml\Commandes;

// Toute classe e controller Front Office doit hériter de la casllse ci-dessous
//class Liste extends Magento\Framework\App\Action\Action




class Liste extends \Magento\Backend\App\Action
{


    public function execute() {


                $this->_view->loadLayout();
                $this->_view->renderLayout();


    }





}
