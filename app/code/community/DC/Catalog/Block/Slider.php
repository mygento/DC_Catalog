<?php

class DC_Catalog_Block_Slider extends Mage_Core_Block_Template
{

    protected $_valuesCollection = null;
    protected $_attributeCode = null;

    public function _construct()
    {
        $this->setTemplate('dc_catalog/list/slider.phtml');
    }

    public function getAttributeCode()
    {
        if (!$this->_attributeCode) {
            if (!$this->_attributeCode = $this->getData('attribute_code')) {
                if (!$this->_attributeCode = $this->getData('default_attribute_code')) {
                    $this->_attributeCode = 'manufacturer';
                }
            }
        }
        return $this->_attributeCode;
    }

    /**
     * @return DC_Catalog_Model_Mysql4_Manufacturer_Collection
     */
    public function getValuesCollection()
    {
        if (null === $this->_valuesCollection) {
            //the attribute value collection
            $this->_valuesCollection = Mage::getModel('dc_catalog/manufacturer')->getCollection();
            echo $this->getAttributeCode();
            //set the store id and the main category from the store
            $this->_valuesCollection
                ->addStoreFilter(Mage::app()->getStore()->getId(), true)
                ->addAttributeCodeFilter($this->getAttributeCode())
                ->addFieldToFilter('image', array('neq' =>'NULL'))
                ->addEnabledFilter();
        }
        return $this->_valuesCollection;
    }
}
