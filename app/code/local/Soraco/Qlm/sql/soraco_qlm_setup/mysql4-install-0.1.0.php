<?php
$installer = new Mage_Eav_Model_Entity_Setup('core_setup');
$installer->startSetup();                   

$installer->addAttribute('catalog_product', 'licparameter', array(
     'type'              => 'varchar',
     'backend'           => '',
     'frontend'          => '',
     'label'             => 'QLM Settings',
     'input'             => 'text',
     'class'             => '',
     'source'            => '',
     'global'            => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
     'visible'           => false,
     'required'          => false,
     'user_defined'      => false,
     'default'           => '',
     'searchable'        => false,
     'filterable'        => false,
     'comparable'        => false,
     'visible_on_front'  => false,
     'unique'            => false,
     'apply_to'          => '',
     'is_configurable'   => false
));

$installer->endSetup();
	 
