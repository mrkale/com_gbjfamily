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
 * Methods handling list of records.
 *
 * @since  3.8
 */
class GbjfamilyModelIncomes extends GbjSeedModelList
{
	/**
	 * Calculates statistics from filtered records.
	 *
	 * @return  array  The list of statistics variables and values.
	 */
	public function getStatistics()
	{
		$statistics['price']['cnt'] = 0;
		$statistics['price']['sum'] = 0;
		$statistics['price']['avg'] = 0;
		$statistics['price']['max'] = 0;
		$statistics['price']['min'] = null;

		foreach ($this->getItems() as $recordObject)
		{
			$statistics['price']['cnt'] += 1;
			$statistics['price']['sum'] += $recordObject->price;
			$statistics['price']['max'] = max($recordObject->price, $statistics['price']['max']);
			$statistics['price']['min'] = min($recordObject->price, $statistics['price']['min'] ?? $statistics['price']['max']);
		}

		if ($statistics['price']['cnt'] <> 0)
		{
			$statistics['price']['avg'] = $statistics['price']['sum'] / $statistics['price']['cnt'];
		}

		return $statistics;
	}
}
