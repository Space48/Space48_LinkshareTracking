<?php
class Space48_Linkshare_Block_Success extends Space48_Linkshare_Block_Abstract
{
    /**
     * constructor
     */

    public function _construct()
    {
        parent::_construct();

        // set the default template, this can
        // be overidden in the layout xml
        $this->setTemplate('space48/linkshare/success.phtml');
    }

    /**
     * Get the image tag
     *
     * @return string currency code
     */
    public function getImageTag() {

        $storeId = $this->getStoreId();
        $imgTagArray = array();
        if ($order = $this->getLastOrder()) {

            $imgTagArray['src']   = $this->_getHelper()->getLinkshareUrl($storeId);
            $imgTagArray['mid']   = Mage::getStoreConfig('Space48_Linkshare/linkshare/mid',$storeId);
            $imgTagArray['ord']   = $this->getLastOrderId();
            $imgTagArray['cur']   = $this->getCurrencyCode($storeId);
            $imgTagArray['lines'] = $this->getTrackingLinesString($order,$storeId = null);
        }
        return $imgTagArray;
    }

    /**
     * Get the tracking string for Order Items
     *
     * @return string currency code
     */
    protected function getTrackingLinesString($order,$storeId = null)
    {
        $trackingLines = '';
        foreach ($order->getAllVisibleItems() as $item) {
            if (!$item->getParentItem()) {
                $skus[] = $item->getSku() ? urlencode($item->getSku()) : '';
                $amts[] = $item->getData('base_price') ? round((number_format($item->getData('base_price'), '2', '.', '.') * $item->getQtyOrdered()) * 100) : 0;
                $qtys[] = $item->getQtyOrdered() ? $item->getQtyOrdered() : 0;
                $name[] = $item->getName() ? urlencode($this->removeInvalidChars($item->getName())) : '';
            }
        }

        if ($order->getBaseDiscountAmount() > 0) {
            $skus[] = 'Discount';
            $amts[] = round($order->getDiscountAmount() * 100);
            $qtys[] = '0';
            $name[] = 'Discount';
        }

        $trackingLines .=
            'skulist=' .  implode('|', $skus) . '&' .
            'amtlist=' . implode('|', $amts) . '&' .
            'qlist=' . implode('|', $qtys) . '&' .
            'namelist=' . implode('|', $name) . '&' .
            'cur=' .      implode('|', $this->getCurrencyCode($storeId));

        return $trackingLines;
    }
}
