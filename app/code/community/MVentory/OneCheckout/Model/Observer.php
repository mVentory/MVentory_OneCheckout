<?php 

/**
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Loewenstark Magento License (LML 1.0).
 * It is  available through the world-wide-web at this URL:
 * http://www.loewenstark.de/licenses/lml-1.0.html
 * If you are unable to obtain it through the world-wide-web, please send an 
 * email to license@loewenstark.de so we can send you a copy immediately.
 *
 * @category   MVentory
 * @package    MVentory_OneCheckout
 * @copyright  Copyright (c) 2012 Ulrich Abelmann
 * @copyright  Copyright (c) 2012 wwg.löwenstark im Internet GmbH
 * @license    http://www.loewenstark.de/licenses/lml-1.0.html  Loewenstark Magento License (LML 1.0)
 */

class MVentory_OneCheckout_Model_Observer extends Mage_Core_Model_Abstract {
	
	public function redirect($observer) {
		//if (Mage::helper("onecheckout")->isActive()) {
			$response = Mage::app()->getResponse();
			$url = Mage::helper("onecheckout/checkout_url")->getCheckoutUrl();
			$response->setRedirect($url);
		//}
	}

  public function setAddresses($observer) {
		Mage::helper("onecheckout")->setAddresses();
	}
}
