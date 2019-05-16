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
		$this->addButtonEnter('Expenses');
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

		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_MEASURE'), JText::_('COM_GBJFAMILY_EXPENSES_STATS_LABEL'));
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE'), JText::_('LIB_GBJ_STAT_CNT'),
			$this->statistics['expenses']['cnt']
		);
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE_UNIT'), JText::_('LIB_GBJ_STAT_SUM'),
			Helper::formatNumber($this->statistics['expenses']['sum'], JText::_('LIB_GBJ_FIELD_PRICE_FORMAT')),
			JText::_('LIB_GBJ_UNIT_EUR')
		);
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE'), JText::_('LIB_GBJ_STAT_AVG'),
			Helper::formatNumber($this->statistics['expenses']['avg'], JText::_('LIB_GBJ_FIELD_PRICE_FORMAT'))
		);

		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_MEASURE'), JText::_('COM_GBJFAMILY_EVENTS_STATS_LABEL'));
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE'), JText::_('LIB_GBJ_STAT_CNT'),
			$this->statistics['events']['cnt']
		);
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE_UNIT'), JText::_('LIB_GBJ_STAT_SUM'),
			Helper::formatNumber($this->statistics['events']['sum'], JText::_('COM_GBJFAMILY_EVENT_DURATION_FORMAT')),
			JText::_('LIB_GBJ_UNIT_HOURS')
		);
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE'), JText::_('LIB_GBJ_STAT_AVG'),
			Helper::formatNumber($this->statistics['events']['sum'], JText::_('COM_GBJFAMILY_EVENT_DURATION_FORMAT'))
		);

		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_MEASURE'), JText::_('COM_GBJFAMILY_INCOMES_STATS_LABEL'));
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE'), JText::_('LIB_GBJ_STAT_CNT'),
			$this->statistics['incomes']['cnt']
		);
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE_UNIT'), JText::_('LIB_GBJ_STAT_SUM'),
			Helper::formatNumber($this->statistics['incomes']['sum'], JText::_('LIB_GBJ_FIELD_PRICE_FORMAT')),
			JText::_('LIB_GBJ_UNIT_EUR')
		);
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE'), JText::_('LIB_GBJ_STAT_AVG'),
			Helper::formatNumber($this->statistics['incomes']['avg'], JText::_('LIB_GBJ_FIELD_PRICE_FORMAT'))
		);

		return $htmlString;
	}
}
