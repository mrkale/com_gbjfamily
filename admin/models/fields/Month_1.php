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
 * Class for custom field Month
 *
 * @since  3.8
 */
class JFormFieldMonth extends GbjSeedFieldList
{
	/**
	 * Creating HTML options for the select custom field
	 *
	 * @return array  List of HTML option objects
	 */
	public function getOptions()
	{
		$months = array(
			'JANUARY',
			'FEBRUARY',
			'MARCH',
			'APRIL',
			'MAY',
			'JUNE',
			'JULY',
			'AUGUST',
			'SEPTEMBER',
			'OCTOBER',
			'NOVEMBER',
			'DECEMBER',
		);
		$rows = array();

		for ($i = 1; $i <= 12; $i++)
		{
			$month = new stdClass;
			$month->value = $i;
			$month->text = JText::_($months[$i - 1]);
			$rows[] = $month;
		}

		$options = array_merge(parent::getOptions(), $rows);

		return $options;
	}
}
