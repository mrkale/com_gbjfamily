<?php
/**
 * @package    Joomla.Component
 * @copyright  (c) 2017 Libor Gabaj
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * @since      3.8
 */

// No direct access
defined('_JEXEC') or die;

/**
 * Installation script for component COM_GBJFAMILY
 *
 * @since  3.8
 */
class Com_GbjfamilyInstallerScript
{
	/**
	 * Actions at installing the component
	 *
	 * @param   object  $parent  Installer object
	 *
	 * @return  none
	 */
	public function install($parent)
	{
		echo '<p>' . JText::_('COM_GBJFAMILY_INSTALL_TEXT') . '</p>';
	}

	/**
	 * Actions at uninstalling the component
	 *
	 * @param   object  $parent  Installer object
	 *
	 * @return  none
	 */
	public function uninstall($parent)
	{
//		echo '<p>' . JText::_('COM_GBJFAMILY_UINSTALL_TEXT') . '</p>';
	}

	/**
	 * Actions at updating the component
	 *
	 * @param   object  $parent  Installer object
	 *
	 * @return  none
	 */
	public function update($parent)
	{
//		echo '<p>' . JText::_('COM_GBJFAMILY_UPDATE_TEXT') . '</p>';
	}

	/**
	 * Actions before installing the component
	 *
	 * @param   string  $type    Type of action (DISCOVER, INSTALL, UNINSTALL, UPDATE)
	 * @param   object  $parent  Installer object
	 *
	 * @return  none
	 */
	public function preflight($type, $parent)
	{
//		echo '<p>' . JText::_('COM_GBJFAMILY_PREFLIGHT_' . strtoupper($type) . '_TEXT') . '</p>';
	}

	/**
	 * Actions after installing the component
	 *
	 * @param   string  $type    Type of action (DISCOVER, INSTALL, UNINSTALL, UPDATE)
	 * @param   object  $parent  Installer object
	 *
	 * @return  none
	 */
	public function postflight($type, $parent)
	{
//		echo '<p>' . JText::_('COM_GBJFAMILY_POSTFLIGHT_' . strtoupper($type) . '_TEXT') . '</p>';
	}
}
