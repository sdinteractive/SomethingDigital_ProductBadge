<?php

class SomethingDigital_ProductBadge_Model_Source_Badge extends Mage_Eav_Model_Entity_Attribute_Source_Abstract {
    
    static $cachedOptions = null;
    
    public function getAllOptions() {
        if (is_null(SomethingDigital_ProductBadge_Model_Source_Badge::$cachedOptions)) {
            $options = array();
            $data = Mage::helper('sd_productbadge')->getBadgesInfo();
            foreach ($data as $badge) {
                $options[] = array(
                    'value' => $badge['class'],
                    'label' => $badge['name']
                );
            }
            array_unshift($options, array('value'=>'0', 'label'=> Mage::helper('sd_productbadge')->__('None')));
            self::$cachedOptions = $options;
        }

        return SomethingDigital_ProductBadge_Model_Source_Badge::$cachedOptions;
    }

    /**
     * Retrieve flat column definition
     *
     * @return array
     */
    public function getFlatColums()
    {
        $attributeCode = $this->getAttribute()->getAttributeCode();
        $column = array(
            'default'   => null
        );

        if (Mage::helper('core')->useDbCompatibleMode()) {
            $column['type']     = 'varchar';
            $column['is_null']  = true;
        } else {
            $column['type']     = Varien_Db_Ddl_Table::TYPE_VARCHAR;
            $column['nullable'] = true;
            $column['comment']  = $attributeCode . ' column';
        }

        return array($attributeCode => $column);
    }

    /**
     * Retrieve Select For Flat Attribute update
     *
     * @param int $store
     * @return Varien_Db_Select|null
     */
    public function getFlatUpdateSelect($store)
    {
        return Mage::getResourceModel('eav/entity_attribute')
            ->getFlatUpdateSelect($this->getAttribute(), $store);
    }
}
