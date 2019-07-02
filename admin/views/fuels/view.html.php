<?php
/**
 * @package    Joomla.Component
 * @copyright  (c) 2019 Libor Gabaj
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * @since      3.8
 */

// No direct access
defined('_JEXEC') or die;

/**
 * View for handling fuel records
 *
 * @since  3.8
 */
class GbjfamilyViewFuels extends GbjSeedViewList
{
	/**
	 * Create HTML string for displaying statistics.
	 *
	 * @return  string  HTML display string.
	 */
	public function htmlStatistics()
	{
		$htmlString = parent::htmlStatistics();

		// Quantity
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_MEASURE'),
			JText::_('COM_GBJFAMILY_FIELD_FUEL_QUANTITY_LABEL')
		);
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE'), JText::_('LIB_GBJ_STAT_SUM'),
			Helper::formatNumber($this->statistics['quantity']['sum'], JText::_('COM_GBJFAMILY_FIELD_FUEL_QUANTITY_FORMAT'))
		);
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE'), JText::_('LIB_GBJ_STAT_AVG'),
			Helper::formatNumber($this->statistics['quantity']['avg'], JText::_('COM_GBJFAMILY_FIELD_FUEL_QUANTITY_FORMAT'))
		);
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_RANGE'), JText::_('LIB_GBJ_STAT_RNG'),
			Helper::formatNumber($this->statistics['quantity']['min'], JText::_('COM_GBJFAMILY_FIELD_FUEL_QUANTITY_FORMAT')),
			Helper::formatNumber($this->statistics['quantity']['max'], JText::_('COM_GBJFAMILY_FIELD_FUEL_QUANTITY_FORMAT'))
		);

		// Period
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_MEASURE'),
			JText::_('COM_GBJFAMILY_FIELD_FUEL_PERIOD_LABEL')
		);
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE'), JText::_('LIB_GBJ_STAT_SUM'),
			Helper::formatNumber($this->statistics['period']['sum'], JText::_('COM_GBJFAMILY_FIELD_FUEL_PERIOD_FORMAT'))
		);
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE'), JText::_('LIB_GBJ_STAT_AVG'),
			Helper::formatNumber($this->statistics['period']['avg'], JText::_('COM_GBJFAMILY_FIELD_FUEL_PERIOD_FORMAT'))
		);
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_RANGE'), JText::_('LIB_GBJ_STAT_RNG'),
			Helper::formatNumber($this->statistics['period']['min'], JText::_('COM_GBJFAMILY_FIELD_FUEL_PERIOD_FORMAT')),
			Helper::formatNumber($this->statistics['period']['max'], JText::_('COM_GBJFAMILY_FIELD_FUEL_PERIOD_FORMAT'))
		);

		// Distance
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_MEASURE'),
			JText::_('COM_GBJFAMILY_FIELD_FUEL_DISTANCE_LABEL')
		);
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE'), JText::_('LIB_GBJ_STAT_SUM'),
			Helper::formatNumber($this->statistics['distance']['sum'], JText::_('COM_GBJFAMILY_FIELD_FUEL_DISTANCE_FORMAT'))
		);
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE'), JText::_('LIB_GBJ_STAT_AVG'),
			Helper::formatNumber($this->statistics['distance']['avg'], JText::_('COM_GBJFAMILY_FIELD_FUEL_DISTANCE_FORMAT'))
		);
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_RANGE'), JText::_('LIB_GBJ_STAT_RNG'),
			Helper::formatNumber($this->statistics['distance']['min'], JText::_('COM_GBJFAMILY_FIELD_FUEL_DISTANCE_FORMAT')),
			Helper::formatNumber($this->statistics['distance']['max'], JText::_('COM_GBJFAMILY_FIELD_FUEL_DISTANCE_FORMAT'))
		);

		// Consumption
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_MEASURE'),
			JText::_('COM_GBJFAMILY_FIELD_FUEL_CONSUMPTION_LABEL')
		);
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE'), JText::_('LIB_GBJ_STAT_AVG'),
			Helper::formatNumber($this->statistics['consumption']['avg'], JText::_('COM_GBJFAMILY_FIELD_FUEL_CONSUMPTION_FORMAT'))
		);
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_RANGE'), JText::_('LIB_GBJ_STAT_RNG'),
			Helper::formatNumber($this->statistics['consumption']['min'], JText::_('COM_GBJFAMILY_FIELD_FUEL_CONSUMPTION_FORMAT')),
			Helper::formatNumber($this->statistics['consumption']['max'], JText::_('COM_GBJFAMILY_FIELD_FUEL_CONSUMPTION_FORMAT'))
		);

		return $htmlString;
	}
}
