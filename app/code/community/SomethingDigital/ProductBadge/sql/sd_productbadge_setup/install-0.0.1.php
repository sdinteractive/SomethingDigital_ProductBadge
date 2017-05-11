<?php
/** @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();

$installer->addAttribute(Mage_Catalog_Model_Product::ENTITY, 'badge', array(
    'type' => 'varchar',
    'source' => 'sd_productbadge/source_badge',
    'group' => 'General',
    'label' => 'Badge',
    'input' => 'select',
    'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
    'is_visible' => 1,
    'required' => 0,
    'searchable' => 0,
    'filterable' => 0,
    'unique' => 0,
    'comparable' => 0,
    'visible_on_front' => 0,
    'user_defined' => 1,
    'used_in_product_listing' => 1
));
$installer->endSetup();