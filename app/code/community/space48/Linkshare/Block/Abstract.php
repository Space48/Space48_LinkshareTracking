<?php
class Space48_Linkshare_Block_Abstract extends Mage_Core_Block_Template
{
    /**
     * is enabled
     *
     * @return bool
     */

    public function isEnabled()
    {
        if($this->getMerchantId() == false){
            return false;
        }
        if($this->getLinkshareProtocol() == false){
            return false;
        }
        return true;
    }

    /**
     * to html
     *
     * @return string
     */

    protected function _toHtml()
    {
        if (!$this->isEnabled()) {
            return false;
        }

        return parent::_toHtml();
    }

    /**
     * get last order id
     *
     * @return int|null
     */
    protected function getLastOrderId()
    {
        return 100028129;
        return Mage::getSingleton('checkout/session')->getLastRealOrderId();
    }

    /**
     * get last order
     *
     * @return Mage_Sales_Model_Order
     */
    public function getLastOrder()
    {
        if (!$this->getData('last_order')) {
            // get order model
            $order = Mage::getModel('sales/order');

            // if we have the id then load order
            if ($id = $this->getLastOrderId()) {
                $order->loadByIncrementId($id);
            }

            $this->setData('last_order', $order);
        }

        return $this->getData('last_order');
    }

    /**
     * Get the current Store ID
     *
     * @return str | int StoreId
     */

    protected function getStoreId()
    {
        return Mage::app()->getStore()->getStoreId();
    }

    /**
     * Get the stores currency code
     *
     * @return string currency code
     */

    public function getCurrencyCode($storeId = null)
    {
        return $this->_getHelper()->getCurrencyCode($storeId);
    }

    /**
     *  get MID setting from the adminHTML section
     *  of Magento system.
     *
     * @return int mixed MID for the LinkShare system
     */

    public function getMerchantId($storeId = null)
    {
        return Mage::getStoreConfig('Space48_Linkshare/linkshare/mid', $storeId);
    }

    /**
     * Get the HTTP protocol to use when integrating with PIXEL tracking
     *
     * @return string HTTP/S protocol to use.
     */

    public function getLinkshareProtocol()
    {
        return Mage::getStoreConfig('Space48_Linkshare/linkshare/protocol');
    }

    /**
     * Get an instance fo the module's helper function
     *
     * @return helper Object
     */

    protected function _getHelper()
    {
        return Mage::helper('space48_linkshare');
    }

    /**
     * Replace Invalid Chars from String
     *
     * @return str
     */
    protected function removeInvalidChars($str)
    {
        if(strpos($str, '|')) {
            return str_replace('|','-',$str);
        }
        return $str;

    }


}
