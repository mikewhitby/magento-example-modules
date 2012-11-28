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
 * Thing form container
 *
 * Another container, same as {@link Examples_AdminGridAndForm_Block_Adminhtml_Thing}
 * for all intents and purposes, obviously slightly different as this is a
 * container for a form rather than a grid, so buttons are different, and a
 * different class is inherited, but things are very similar
 *
 * In the same way as the grid container, this class gets instantiated by the
 * magento layout system, see the phpdoc in the grid container class to get
 * a bit more info on how this works
 *
 * @category Examples
 * @package  Examples_AdminGridAndForm
 * @author   Mike Whitby <me@mikewhitby.co.uk>
 */
class Examples_AdminGridAndForm_Block_Adminhtml_Thing_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    /**
     * Class constructor
     */
    public function __construct()
    {
        parent::__construct(); # for form containers, parent constructor should be called first

        $this->_objectId = 'id'; # this is the param we look for in the url to load the entity
        $this->_controller = 'adminhtml_thing'; # same as the grid container
        $this->_blockGroup = 'examples_admingridandform'; # same as the grid container
        $this->_updateButton('save', 'label', Mage::helper('examples_admingridandform')->__('Save Thing')); # sets the text for the save button
        $this->_updateButton('delete', 'label', Mage::helper('examples_admingridandform')->__('Delete Thing')); # sets the text for the delete button
        # adds a save and continue edit button, not needed but nice
        $this->_addButton(
            'save_and_edit_button',
            array(
                'label'     => Mage::helper('examples_admingridandform')->__('Save and Continue Edit'),
                'onclick'   => 'saveAndContinueEdit()',
                'class'     => 'save'
            ),
            100
        );
    }

    /**
     * Get header text
     *
     * @return string
     */
    public function getHeaderText()
    {
        # the text changes depending on if we are editing an existing entity
        # or creating a new one, this is based on a registry item that the
        # controller registers, this will never exist in our examples as we
        # don't have the controller logic to support it
        if (Mage::registry('thing_data') && Mage::registry('thing_data')->getId() ) {
            return Mage::helper('examples_admingridandform')->__("Edit Thing");
        } else {
            return Mage::helper('examples_admingridandform')->__('Add Thing');
        }
    }

    /**
     * Header CSS class
     *
     * Used to set the icon next to the header text, not at all needed but a
     * nice touch. Look at all the headers to see the available icons, or make
     * your own by omitting this and making a CSS rule for .head-adminhtml-thing
     *
     * @return string The CSS class
     */
    public function getHeaderCssClass()
    {
        return 'icon-head head-cms-page';
    }
}
