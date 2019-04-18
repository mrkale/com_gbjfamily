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
 * View for handling asset records
 *
 * @since  3.8
 */
class GbjfamilyViewAssets extends GbjSeedViewList
{
	/**
	 * Create HTML string for displaying statistics.
	 *
	 * @return  string  HTML display string.
	 */
	public function htmlStatistics()
	{
		$htmlString = parent::htmlStatistics();

		// Value
		foreach ($this->statistics['value'] as $key => $value)
		{
			$value = number_format($value,
				JText::_('COM_GBJFAMILY_FORMAT_NUMBER_DECIMALS'),
				JText::_('COM_GBJFAMILY_FORMAT_NUMBER_SEPARATOR_DECIMALS'),
				JText::_('COM_GBJFAMILY_FORMAT_NUMBER_SEPARATOR_THOUSANDS')
			);
			$this->statistics['value'][$key] = $value;
		}

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

		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_MEASURE_UNIT'), JText::_('COM_GBJFAMILY_FIELD_ASSET_VALUE_LABEL'), JText::_('LIB_GBJ_UNIT_EUR'));
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE'), JText::_('LIB_GBJ_STAT_SUM'), $this->statistics['value']['sum']);
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE'), JText::_('LIB_GBJ_STAT_AVG'), $this->statistics['value']['avg']);
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_RANGE'), JText::_('LIB_GBJ_STAT_RNG'), $this->statistics['value']['min'], $this->statistics['value']['max']);

		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_MEASURE_UNIT'), JText::_('LIB_GBJ_FIELD_PRICE_LABEL'), JText::_('LIB_GBJ_UNIT_EUR'));
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE'), JText::_('LIB_GBJ_STAT_SUM'), $this->statistics['price']['sum']);
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_VARIABLE'), JText::_('LIB_GBJ_STAT_AVG'), $this->statistics['price']['avg']);
		$htmlString .= JText::sprintf(JText::_('LIB_GBJ_STAT_RANGE'), JText::_('LIB_GBJ_STAT_RNG'), $this->statistics['price']['min'], $this->statistics['price']['max']);

		return $htmlString;
	}
}
