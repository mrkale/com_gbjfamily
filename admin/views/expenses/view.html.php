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
 * View for handling expense records
 *
 * @since  3.8
 */
class GbjfamilyViewExpenses extends GbjSeedViewList
{
	/**
	 * Create HTML string for displaying statistics.
	 *
	 * @return  string  HTML display string.
	 */
	public function htmlStatistics()
	{
		$htmlString = parent::htmlStatistics();

		// Price
		foreach ($this->statistics['price'] as $key => $value)
		{
			$value = number_format($value,
				JText::_('COM_GBJFAMILY_FORMAT_NUMBER_DECIMALS'),
				JText::_('COM_GBJFAMILY_FORMAT_NUMBER_SEPARATOR_DECIMALS'),
				JText::_('COM_GBJFAMILY_FORMAT_NUMBER_SEPARATOR_THOUSANDS')
			);
			$this->statistics['price'][$key] = $value;
		}

		// Quantity
		foreach ($this->statistics['quantity'] as $key => $value)
		{
			$value = number_format($value,
				JText::_('COM_GBJFAMILY_FORMAT_NUMBER_DECIMALS'),
				JText::_('COM_GBJFAMILY_FORMAT_NUMBER_SEPARATOR_DECIMALS'),
				JText::_('COM_GBJFAMILY_FORMAT_NUMBER_SEPARATOR_THOUSANDS')
			);
			$this->statistics['quantity'][$key] = $value;
		}

		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_MEASURE_UNIT'), JText::_('LIB_GBJ_FIELD_PRICE_LABEL'), JText::_('LIB_GBJ_UNIT_EUR'));
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE'), JText::_('LIB_GBJ_STAT_SUM'), $this->statistics['price']['sum']);
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE'), JText::_('LIB_GBJ_STAT_AVG'), $this->statistics['price']['avg']);
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_RANGE'), JText::_('LIB_GBJ_STAT_RNG'), $this->statistics['price']['min'], $this->statistics['price']['max']);

		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_MEASURE'), JText::_('COM_GBJFAMILY_FIELD_EXPENSE_QUANTITY_LABEL'));
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE'), JText::_('LIB_GBJ_STAT_SUM'), $this->statistics['quantity']['sum']);
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE'), JText::_('LIB_GBJ_STAT_AVG'), $this->statistics['quantity']['avg']);
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_RANGE'), JText::_('LIB_GBJ_STAT_RNG'), $this->statistics['quantity']['min'], $this->statistics['quantity']['max']);

		return $htmlString;
	}
}
