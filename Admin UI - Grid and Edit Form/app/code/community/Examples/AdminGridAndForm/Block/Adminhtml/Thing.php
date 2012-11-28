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
 * Thing grid container
 *
 * As the name above suggests (although not the actual class name), this is a
 * container for the grid, so this class is responsible for outputting the bits
 * around the grid, such as the header, the top right buttons, etc. It is also
 * responsible for instantiating the grid class and adding it a child of this
 * block, it does this by creating a grouped class name from a combination of
 * the _blockGroup and _controller (very badly named!) properties
 *
 * This class gets instantiated by the magento layout system, see
 * {@link app/design/adminhtml/default/default/layout/mikewhitby/adminexample.xml}
 * for where this is defined, the layout system is kicked off as normal in the
 * controller by calling <code>$this->loadLayout();</code> and then
 * <code>$this->renderLayout();</code>
 *
 * @category Examples
 * @package  Examples_AdminGridAndForm
 * @author   Mike Whitby <me@mikewhitby.co.uk>
 */
class Examples_AdminGridAndForm_Block_Adminhtml_Thing extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    /**
     * Class constructor
     */
    public function __construct()
    {
        $this->_controller = 'adminhtml_thing'; # this is the common prefix in the second part of the grouped class name, i.e. whatever/(this_bit)
        $this->_blockGroup = 'examples_admingridandform'; # the first part of the grouped class name, i.e. (some_module)/whatever
        $this->_headerText = Mage::helper('examples_admingridandform')->__('Things'); # sets the name in the header
        $this->_addButtonLabel = Mage::helper('examples_admingridandform')->__('Add New Thing'); # sets the text for the add button

        parent::__construct(); # for grid containers, parent constructor must be called last - not good design
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
