<?php
/**
 * @package    Joomla.Component
 * @copyright  (c) 2018 Libor Gabaj
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * @since      3.8
 */

// No direct access
defined('_JEXEC') or die;

/**
 * View for handling agenda records
 *
 * @since  3.8
 */
class GbjfamilyViewProjects extends GbjSeedViewList
{
	/**
	 * Method to create the toolbar for handling agenda records.
	 *
	 * @return  void
	 */
	protected function addToolbar()
	{
		parent::addToolbar();
		$this->addButtonEnter('Events');
	}
	/**
	 * Create HTML string for displaying statistics.
	 *
	 * @return  string  HTML display string.
	 */
	public function htmlStatistics()
	{
		$htmlString = parent::htmlStatistics();
		$htmlString .= JText::_('LIB_GBJ_STAT_DELIM_VARIABLE') .  JText::_('COM_GBJFAMILY_FIELD_CODEBOOK_EVENTS_LABEL') . JText::_('LIB_GBJ_STAT_DELIM_LABEL');
		$htmlString .= JText::sprintf('%d (%d)', $this->statistics['events']['sum'], $this->statistics['events']['cnt']);
		$htmlString .= JText::_('LIB_GBJ_STAT_DELIM_VALUE') . JText::_('LIB_GBJ_STAT_AVG');
		$htmlString .= JText::sprintf('%8.1f', $this->statistics['events']['avg']);

		return $htmlString;
	}
}
