<?php
/**
 * Examples
 *
 * PHP Version 5
 *
 * @category  Examples
 * @package   Examples_AdminGridAndForm
 * @author    Mike Whitby <me@mikewhitby.co.uk>
 * @copyright Copyright (c) 2012 Mike Whitby (http://www.mikewhitby.co.uk)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @link      N/A
 */

/**
 * Thing form
 *
 * This class gets instantiated by it's container, which is of type
 * {@link Examples_AdminGridAndForm_Block_Adminhtml_Thing_Edit}. This class is
 * responsible for creating the actual HTML form, with all the fieldsets and
 * inputs etc, so this is the actual <form></form> and everything in it
 *
 * What might not be obvious is that this form is used for both addition and
 * editing of whatever entity type it is you are working with. You won't get to
 * see this though as this relies on the controller registering certain data
 * so this form will act as though it is adding a new entity all the time,
 * whereas in reality you would code the controller to register some data to
 * allow it to work as an 'edit', rather than a 'new' form.
 *
 * @category Examples
 * @package  Examples_AdminGridAndForm
 * @author   Mike Whitby <me@mikewhitby.co.uk>
 */
class Examples_AdminGridAndForm_Block_Adminhtml_Thing_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    /**
     * Prepare form before rendering HTML
     *
     * @return Mage_Adminhtml_Block_Widget_Form
     */
    protected function _prepareForm()
    {
        # create the form with the essential information, such as DOM ID, action
        # attribute, method and the enc type (this is needed if you have image
        # inputs in your form, and doesn't hurt to use otherwise)
        $form = new Varien_Data_Form(
            array(
                'id'      => 'edit_form',
                'action'  => $this->getUrl('*/*/save', array('id' => $this->getRequest()->getParam('id'))),
                'method'  => 'post',
                'enctype' => 'multipart/form-data'
            )
        );
        $form->setUseContainer(true);
        $this->setForm($form);

        # you can add fields direct to the form, without a fieldset
        $form->addField(
            'fake_note',
            'note',
            array(
                'text' => '<ul class="messages"><li class="notice-msg"><ul><li>'
                        .  Mage::helper('examples_admingridandform')->__('This form is fake, so the data in the grid '
                                      . 'you just clicked on won\'t be here, do not be alarmed, this is normal')
                        . '</li></ul></li></ul>',
            )
        );

        # add a fieldset, this returns a Varien_Data_Form_Element_Fieldset object
        $fieldset = $form->addFieldset(
            'base_fieldset',
            array(
                'legend' => Mage::helper('examples_admingridandform')->__('General Information'),
            )
        );
        # now add fields on to the fieldset object, for more detailed info
        # see https://makandracards.com/magento/12737-admin-form-field-types
        $fieldset->addField(
            'name', # the input id
            'text', # the type
            array(
                'label'    => Mage::helper('examples_admingridandform')->__('Name'),
                'class'    => 'required-entry',
                'required' => true,
                'name'     => 'name',
            )
        );
        $fieldset->addField(
            'short_description',
            'textarea',
            array(
                'label' => Mage::helper('examples_admingridandform')->__('Short Description'),
                'name'  => 'short_description',
            )
        );
        $fieldset->addField(
            'long_description',
            'textarea',
            array(
                'label' => Mage::helper('examples_admingridandform')->__('Long Description'),
                'name'  => 'long_description',
                'note'  => 'The long description didn\'t appear in the grid',
            )
        );

        # we can use multiple fieldsets
        $fieldset = $form->addFieldset(
            'stock_fieldset',
            array(
                'legend' => Mage::helper('examples_admingridandform')->__('Stock'),
            )
        );
        $fieldset->addField(
            'stock_note',
            'note',
            array(
                'text' => Mage::helper('examples_admingridandform')->__('A note field can be used to inform users of '
                                      . 'something, they look a bit naff though. You can add any HTML you fancy to '
                                      . 'make them look better, such as the note at the top of this form does'),
            )
        );
        $fieldset->addField(
            'quantity',
            'text',
            array(
                'label'    => Mage::helper('examples_admingridandform')->__('Quantity'),
                'class'    => 'required-entry',
                'required' => true,
                'name'     => 'quantity',
            )
        );
        
        return parent::_prepareForm();
    }
}
