<?php

class SomethingDigital_ProductBadge_Helper_Data extends Mage_Core_Helper_Abstract
{
    const BADGE_INFO_CONFIG_PATH = 'catalog/productbadge/list';
    
    static $mappedBadges = null;
    
    /**
     * Returns product badge style class
     * 
     * @param Mage_Catalog_Model_Product $product
     * @param bool $force
     * @return string
     */
    public function getProductBadgeClass($product, $force = false) {
        if (!($product instanceof Mage_Catalog_Model_Product)) {
            return '';
        }
        if (!$product->getBadge() && $force) {
            $product->setBadge(
                Mage::getResourceSingleton('catalog/product')
                    ->getAttributeRawValue($product->getId(), 'badge', Mage::app()->getStore())
            );
        }
        return !$product->getBadge() ?  '' : (string)$product->getBadge();            
    }

    /**
     * Returns product badge label by class
     *
     * @param string $badgeClass
     * @return string
     */
    public function getProductBadgeLabelByClass($badgeClass) {
        if (is_null(self::$mappedBadges)) {
            $badges = $this->getBadgesInfo();
            self::$mappedBadges = array();
            //fill array for handy mapping badge class to label
            foreach ($badges as $badge) {
                self::$mappedBadges[$badge['class']] = $badge['name'];
            }
        }
        return ($badgeClass && isset(self::$mappedBadges[$badgeClass])) ? self::$mappedBadges[$badgeClass] : '';
    }

    /**
     * Returns badge list from config
     * @return array
     */
    public function getBadgesInfo() {
        if (
            ($badges = Mage::getStoreConfig(self::BADGE_INFO_CONFIG_PATH)) &&
            ($badgeData = unserialize($badges))
        ) {
            return $badgeData['badge'];
        } else {
            return array();
        }
    }
}
