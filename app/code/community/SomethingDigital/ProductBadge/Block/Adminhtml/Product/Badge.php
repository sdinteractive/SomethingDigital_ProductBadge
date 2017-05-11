<?php

class SomethingDigital_ProductBadge_Block_Adminhtml_Product_Badge extends Mage_Adminhtml_Block_System_Config_Form_Field
{
    protected $_addRowButtonHtml = array();
    protected $_removeRowButtonHtml = array();

    /**
     * Returns html part of the setting
     *
     * @param Varien_Data_Form_Element_Abstract $element
     * @return string
     */
    protected function _getElementHtml(Varien_Data_Form_Element_Abstract $element)
    {
        $this->setElement($element);

        $rowTemplate = '<div id="product_badge_template">' .  $this->_getRowTemplateHtml() . '</div>';

        $html = '<ul id="product_badge_container">';
        if ($this->_getValue('badge')) {
            $badgesCount = count($this->_getValue('badge'));
            foreach (array_keys($this->_getValue('badge')) as $index) {
                $html .= $this->_getRowTemplateHtml($index);
            }
        } else {
            $badgesCount = 0;
        }
        $html .= '</ul>';
        $html .= "<script>var lastProductBadgeId = " . $badgesCount . ";" .  
            "var newProductBadgetemplate = new Template('" . addslashes($rowTemplate) . "');</script>";
        $html .= $this->_getAddRowButtonHtml('product_badge_container',
            'product_badge_template', $this->__('Add New Badge'), $badgesCount);

        return $html;
    }

    /**
     * Retrieve html template for setting
     *
     * @param int $rowIndex
     * @return string
     */
    protected function _getRowTemplateHtml($rowIndex = null)
    {
        $html = '<li>';

        $html .= '<div style="margin:5px 0 10px;">';
        $html .= '<input name="' . $this->getElement()->getName() . '[badge][' .
            (!is_null($rowIndex) ? $rowIndex : '#{badge_id}') . '][name]" value="' . 
            $this->_getValue('badge/' . $rowIndex . '/name') . '" ' . $this->_getDisabled() . '/> ';

        $html .= '<input name="' . $this->getElement()->getName() . '[badge][' .
            (!is_null($rowIndex) ? $rowIndex : '#{badge_id}') . '][class]" value="' . 
            $this->_getValue('badge/' . $rowIndex . '/class') . '" ' . $this->_getDisabled() . '/> ';

        $html .= $this->_getRemoveRowButtonHtml();
        $html .= '</div>';
        $html .= '</li>';

        return $html;
    }

    protected function _getDisabled()
    {
        return $this->getElement()->getDisabled() ? ' disabled' : '';
    }

    protected function _getValue($key)
    {
        return $this->getElement()->getData('value/' . $key);
    }

    protected function _getSelected($key, $value)
    {
        return $this->getElement()->getData('value/' . $key) == $value ? 'selected="selected"' : '';
    }

    protected function _getAddRowButtonHtml($container, $template, $title='Add')
    {
        if (!isset($this->_addRowButtonHtml[$container])) {
            $this->_addRowButtonHtml[$container] = $this->getLayout()->createBlock('adminhtml/widget_button')
                ->setType('button')
                ->setClass('add ' . $this->_getDisabled())
                ->setLabel($this->__($title))
                ->setOnClick(
                    "Element.insert($('" . $container . "'), {bottom: newProductBadgetemplate.evaluate({badge_id:" .
                    "lastProductBadgeId++})});"
                )
                ->setDisabled($this->_getDisabled())
                ->toHtml();
        }
        return $this->_addRowButtonHtml[$container];
    }

    protected function _getRemoveRowButtonHtml($selector = 'li', $title = 'Delete')
    {
        if (!$this->_removeRowButtonHtml) {
            $this->_removeRowButtonHtml = $this->getLayout()->createBlock('adminhtml/widget_button')
                ->setType('button')
                ->setClass('delete v-middle ' . $this->_getDisabled())
                ->setLabel($this->__($title))
                ->setOnClick("Element.remove($(this).up('" . $selector . "'))")
                ->setDisabled($this->_getDisabled())
                ->toHtml();
        }
        return $this->_removeRowButtonHtml;
    }
}
