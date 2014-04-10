<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE-OSL.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * @package MVentory/OneCheckout
 * @copyright Copyright (c) 2014 mVentory Ltd. (http://mventory.com)
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 */

/**
 * OneCheckout payment methods block
 *
 * @package MVentory/OneCheckout
 * @author Anatoly A. Kazantsev <anatoly@mventory.com>
 */
class MVentory_OneCheckout_Block_Mage_Checkout_Onepage_Payment_Methods
  extends Mage_Checkout_Block_Onepage_Payment_Methods
{

  /**
   * Retrieve available payment methods
   * The method is redefined to show only Zero Subtotal Checkout (free) payment
   * method when total value (it includes discount) is zero
   *
   * @return array
   */
  public function getMethods () {
    if (($methods = $this->getData('methods')) !== null)
      return $methods;

    $methods = parent::getMethods();

    if (!($methods && $this->getQuote()->getBaseGrandTotal() == 0))
      return $methods;

    $_methods = array();

    foreach ($methods as $method)
      if ($method->getCode() == 'free') {
        $_methods[] = $method;
        break;
      }

    $this->setData('methods', $_methods);

    return $_methods;
  }
}
