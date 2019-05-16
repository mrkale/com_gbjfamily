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
		foreach ($this->statistics['quantity'] as $key => $value)
		{
			$value = Helper::formatNumber(
				$value,
				JText::_('COM_GBJFAMILY_FIELD_FUEL_QUANTITY_FORMAT')
			);
			$this->statistics['quantity'][$key] = $value;
		}

		// Period
		foreach ($this->statistics['period'] as $key => $value)
		{
			$value = Helper::formatNumber(
				$value,
				JText::_('COM_GBJFAMILY_FIELD_FUEL_PERIOD_FORMAT')
			);
			$this->statistics['period'][$key] = $value;
		}

		// Distance
		foreach ($this->statistics['distance'] as $key => $value)
		{
			$value = Helper::formatNumber(
				$value,
				JText::_('COM_GBJFAMILY_FIELD_FUEL_DISTANCE_FORMAT')
			);
			$this->statistics['distance'][$key] = $value;
		}

		// Consumption
		foreach ($this->statistics['consumption'] as $key => $value)
		{
			$value = Helper::formatNumber(
				$value,
				JText::_('COM_GBJFAMILY_FIELD_FUEL_CONSUMPTION_FORMAT')
			);
			$this->statistics['consumption'][$key] = $value;
		}

		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_MEASURE'), JText::_('COM_GBJFAMILY_FIELD_FUEL_QUANTITY_LABEL'));
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE'), JText::_('LIB_GBJ_STAT_SUM'),
			$this->statistics['quantity']['sum']
		);
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE'), JText::_('LIB_GBJ_STAT_AVG'),
			$this->statistics['quantity']['avg']
		);
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_RANGE'), JText::_('LIB_GBJ_STAT_RNG'),
			$this->statistics['quantity']['min'], $this->statistics['quantity']['max']
		);

		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_MEASURE'), JText::_('COM_GBJFAMILY_FIELD_FUEL_PERIOD_LABEL'));
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE'), JText::_('LIB_GBJ_STAT_SUM'),
			$this->statistics['period']['sum']
		);
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE'), JText::_('LIB_GBJ_STAT_AVG'),
			$this->statistics['period']['avg']
		);
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_RANGE'), JText::_('LIB_GBJ_STAT_RNG'),
			$this->statistics['period']['min'], $this->statistics['period']['max']
		);

		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_MEASURE'), JText::_('COM_GBJFAMILY_FIELD_FUEL_DISTANCE_LABEL'));
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE'), JText::_('LIB_GBJ_STAT_SUM'),
			$this->statistics['distance']['sum']
		);
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE'), JText::_('LIB_GBJ_STAT_AVG'),
			$this->statistics['distance']['avg']
		);
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_RANGE'), JText::_('LIB_GBJ_STAT_RNG'),
			$this->statistics['distance']['min'], $this->statistics['distance']['max']
		);

		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_MEASURE'), JText::_('COM_GBJFAMILY_FIELD_FUEL_CONSUMPTION_LABEL'));
//		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE'), JText::_('LIB_GBJ_STAT_SUM'),
//			$this->statistics['consumption']['sum']
//		);
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE'), JText::_('LIB_GBJ_STAT_AVG'),
			$this->statistics['consumption']['avg']
		);
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_RANGE'), JText::_('LIB_GBJ_STAT_RNG'),
			$this->statistics['consumption']['min'], $this->statistics['consumption']['max']
		);

		return $htmlString;
	}
}
