<?php
/**
 * @package    Joomla.Component
 * @copyright  (c) 2018-2019 Libor Gabaj
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
		$this->addButtonEnter('Incomes');
	}
	/**
	 * Create HTML string for displaying statistics.
	 *
	 * @return  string  HTML display string.
	 */
	public function htmlStatistics()
	{
		$htmlString = parent::htmlStatistics();

		// Events
		foreach ($this->statistics['events'] as $key => $value)
		{
			$value = number_format($value,
				JText::_('COM_GBJFAMILY_FORMAT_NUMBER_DECIMALS'),
				JText::_('COM_GBJFAMILY_FORMAT_NUMBER_SEPARATOR_DECIMALS'),
				JText::_('COM_GBJFAMILY_FORMAT_NUMBER_SEPARATOR_THOUSANDS')
			);
			$this->statistics['events'][$key] = $value;
		}

		// Incomes
		foreach ($this->statistics['incomes'] as $key => $value)
		{
			$value = number_format($value,
				JText::_('COM_GBJFAMILY_FORMAT_NUMBER_DECIMALS'),
				JText::_('COM_GBJFAMILY_FORMAT_NUMBER_SEPARATOR_DECIMALS'),
				JText::_('COM_GBJFAMILY_FORMAT_NUMBER_SEPARATOR_THOUSANDS')
			);
			$this->statistics['incomes'][$key] = $value;
		}

		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_MEASURE'), JText::_('COM_GBJFAMILY_EVENTS_STATS_LABEL'));
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE'), JText::_('LIB_GBJ_STAT_CNT'), $this->statistics['events']['cnt']);
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE_UNIT'), JText::_('LIB_GBJ_STAT_SUM'), $this->statistics['events']['sum'],
			JText::_('LIB_GBJ_UNIT_HOURS'));
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE'), JText::_('LIB_GBJ_STAT_AVG'), $this->statistics['events']['avg']);

		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_MEASURE'), JText::_('COM_GBJFAMILY_INCOMES_STATS_LABEL'));
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE'), JText::_('LIB_GBJ_STAT_CNT'), $this->statistics['incomes']['cnt']);
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE_UNIT'), JText::_('LIB_GBJ_STAT_SUM'), $this->statistics['incomes']['sum'],
			JText::_('LIB_GBJ_UNIT_EUR'));
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE'), JText::_('LIB_GBJ_STAT_AVG'), $this->statistics['incomes']['avg']);

		return $htmlString;
	}
}
