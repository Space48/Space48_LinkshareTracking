<?php
class Space48_Linkshare_Block_Referral extends Space48_Linkshare_Block_Abstract
{
    /**
     * constructor
     */
    public function _construct()
    {
        parent::_construct();

        // set the default template, this can
        // be overidden in the layout xml
        $this->setTemplate('space48/linkshare/referral.phtml');
    }
}
