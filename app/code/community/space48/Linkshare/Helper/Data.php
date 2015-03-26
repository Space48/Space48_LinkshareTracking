<?php

class Space48_Linkshare_Helper_Data extends Mage_Core_Helper_Abstract
{

    protected $_cookieLifeSecondsDefault = 2592000;//30 days
    protected $_linkshareProtocolDefault = 'http://track.linksynergy.com';

    /**
     * Get the stores currency code
     *
     * @return string currency code
     */
    public function getCurrencyCode($storeId = null)
    {
        return Mage::app()->getStore($storeId)->getCurrentCurrencyCode();
    }

    /**
     * Get the Cookie Time from config in MS
     *
     * @return string currency code
     */
    protected function getCookieTimeMS($storeId = null)
    {
        if ($days = Mage::getStoreConfig('Space48_Linkshare/linkshare/cookietimedays', $storeId)) {
            return floor($days * 24 * 60 * 60 * 1000);
        }
        return $this->_cookieLifeSecondsDefault * 1000;
    }

    public function getCookieTime($storeId)
    {
        return $this->getCookieTimeMS($storeId);
    }

    public function getLinkshareUrl($storeId = null)
    {
        if ($url = Mage::getStoreConfig('Space48_Linkshare/linkshare/protocol', $storeId)) {
            return $url;
        }
        return $this->_linkshareProtocolDefault;
    }
}