<?php
/**
 * @package    Joomla.Component
 * @copyright  (c) 2017-2018 Libor Gabaj
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
class GbjfamilyViewEvents extends GbjSeedViewList
{
	/**
	 * Create HTML string for displaying statistics.
	 *
	 * @return  string  HTML display string.
	 */
	public function htmlStatistics()
	{
		$htmlString = parent::htmlStatistics();
		$htmlString .= JText::_('LIB_GBJ_STAT_DELIM_VARIABLE') .  JText::_('COM_GBJFAMILY_FIELD_EVENT_DURATION_LABEL') . JText::_('LIB_GBJ_STAT_DELIM_LABEL');
		$htmlString .= JText::sprintf('%8.2f %s (%d)', $this->statistics['duration']['sum'], JText::_('COM_GBJFAMILY_UNIT_HOURS'), $this->statistics['duration']['cnt']);
		$htmlString .= JText::_('LIB_GBJ_STAT_DELIM_VALUE') . JText::_('LIB_GBJ_STAT_AVG');
		$htmlString .= JText::sprintf('%8.2f %s', $this->statistics['duration']['avg'], JText::_('COM_GBJFAMILY_UNIT_HOURS'));

		return $htmlString;
	}
}
