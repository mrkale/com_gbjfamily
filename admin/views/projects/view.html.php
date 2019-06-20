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
		$this->addButtonEnter('Facts');
	}

	/**
	 * Create HTML string for displaying statistics.
	 *
	 * @return  string  HTML display string.
	 */
	public function htmlStatistics()
	{
		$htmlString = parent::htmlStatistics();

		// Expenses
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_MEASURE'), JText::_('COM_GBJFAMILY_EXPENSES_STATS_LABEL'));
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE'), JText::_('LIB_GBJ_STAT_TOT'),
			Helper::formatNumber($this->statistics['expenses']['#'], JText::_('LIB_GBJ_FORMAT_RECORDS'))
		);
		// Price
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_FIELD_UNIT'),
			JText::_('LIB_GBJ_FIELD_PRICE_LABEL'), JText::_('LIB_GBJ_UNIT_EUR')
		);
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE'), JText::_('LIB_GBJ_STAT_CNT'),
			Helper::formatNumber($this->statistics['expenses']['price']['cnt'], JText::_('LIB_GBJ_FORMAT_RECORDS'))
		);
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE'), JText::_('LIB_GBJ_STAT_SUM'),
			Helper::formatNumber($this->statistics['expenses']['price']['sum'], JText::_('LIB_GBJ_FIELD_PRICE_FORMAT'))
		);
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE'), JText::_('LIB_GBJ_STAT_AVG'),
			Helper::formatNumber($this->statistics['expenses']['price']['avg'], JText::_('LIB_GBJ_FIELD_PRICE_FORMAT'))
		);
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_RANGE'), JText::_('LIB_GBJ_STAT_RNG'),
			Helper::formatNumber($this->statistics['expenses']['price']['min'], JText::_('LIB_GBJ_FIELD_PRICE_FORMAT')),
			Helper::formatNumber($this->statistics['expenses']['price']['max'], JText::_('LIB_GBJ_FIELD_PRICE_FORMAT'))
		);

		// Events
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_MEASURE'), JText::_('COM_GBJFAMILY_EVENTS_STATS_LABEL'));
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE'), JText::_('LIB_GBJ_STAT_TOT'),
			Helper::formatNumber($this->statistics['events']['#'], JText::_('LIB_GBJ_FORMAT_RECORDS'))
		);
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_FIELD_UNIT'),
			JText::_('COM_GBJFAMILY_EVENT_DURATION_LABEL'), JText::_('LIB_GBJ_UNIT_HOURS')
		);
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE'), JText::_('LIB_GBJ_STAT_CNT'),
			Helper::formatNumber($this->statistics['events']['duration']['cnt'], JText::_('LIB_GBJ_FORMAT_RECORDS'))
		);
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE'), JText::_('LIB_GBJ_STAT_SUM'),
			Helper::formatNumber($this->statistics['events']['duration']['sum'], JText::_('COM_GBJFAMILY_EVENT_DURATION_FORMAT'))
		);
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE'), JText::_('LIB_GBJ_STAT_AVG'),
			Helper::formatNumber($this->statistics['events']['duration']['avg'], JText::_('COM_GBJFAMILY_EVENT_DURATION_FORMAT'))
		);
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_RANGE'), JText::_('LIB_GBJ_STAT_RNG'),
			Helper::formatNumber($this->statistics['events']['duration']['min'], JText::_('COM_GBJFAMILY_EVENT_DURATION_FORMAT')),
			Helper::formatNumber($this->statistics['events']['duration']['max'], JText::_('COM_GBJFAMILY_EVENT_DURATION_FORMAT'))
		);

		// Incomes
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_MEASURE'), JText::_('COM_GBJFAMILY_INCOMES_STATS_LABEL'));
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE'), JText::_('LIB_GBJ_STAT_TOT'),
			Helper::formatNumber($this->statistics['incomes']['#'], JText::_('LIB_GBJ_FORMAT_RECORDS'))
		);
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_FIELD_UNIT'),
			JText::_('LIB_GBJ_FIELD_PRICE_LABEL'), JText::_('LIB_GBJ_UNIT_EUR')
		);
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE'), JText::_('LIB_GBJ_STAT_CNT'),
			Helper::formatNumber($this->statistics['incomes']['price']['cnt'], JText::_('LIB_GBJ_FORMAT_RECORDS'))
		);
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE'), JText::_('LIB_GBJ_STAT_SUM'),
			Helper::formatNumber($this->statistics['incomes']['price']['sum'], JText::_('LIB_GBJ_FIELD_PRICE_FORMAT'))
		);
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE'), JText::_('LIB_GBJ_STAT_AVG'),
			Helper::formatNumber($this->statistics['incomes']['price']['avg'], JText::_('LIB_GBJ_FIELD_PRICE_FORMAT'))
		);
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_RANGE'), JText::_('LIB_GBJ_STAT_RNG'),
			Helper::formatNumber($this->statistics['incomes']['price']['min'], JText::_('LIB_GBJ_FIELD_PRICE_FORMAT')),
			Helper::formatNumber($this->statistics['incomes']['price']['max'], JText::_('LIB_GBJ_FIELD_PRICE_FORMAT'))
		);

		// Facts
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_MEASURE'), JText::_('COM_GBJFAMILY_FACTS_STATS_LABEL'));
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE'), JText::_('LIB_GBJ_STAT_TOT'),
			Helper::formatNumber($this->statistics['facts']['#'], JText::_('LIB_GBJ_FORMAT_RECORDS'))
		);

		return $htmlString;
	}
}
