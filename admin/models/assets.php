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
 * Methods handling list of records.
 *
 * @since  3.8
 */
class GbjfamilyModelAssets extends GbjSeedModelList
{
	/**
	 * Calculates statistics from filtered records.
	 *
	 * @return  array  The list of statistics variables and values.
	 */
	public function getStatistics()
	{
		$statistics['price'] = $this->getStatisticsPrice();
		$statistics['value'] = $this->getStatisticsValue();

		return $statistics;
	}

	/**
	 * Calculates price statistics from filtered records.
	 *
	 * @return  array  The list of statistics variables and values.
	 */
	public function getStatisticsPrice()
	{
		$statistics['recs'] = 0;
		$statistics['cnt'] = 0;
		$statistics['sum'] = 0;
		$statistics['avg'] = 0;
		$statistics['max'] = 0;
		$statistics['min'] = null;

		foreach ($this->getItems() as $recordObject)
		{
			$statistics['recs'] += 1;

			if ($recordObject->price)
			{
				$statistics['cnt'] += 1;
				$statistics['sum'] += $recordObject->price;
				$statistics['max'] = max($recordObject->price, $statistics['max']);
				$statistics['min'] = min($recordObject->price, $statistics['min'] ?? $statistics['max']);
			}
		}

		if ($statistics['cnt'])
		{
			$statistics['avg'] = $statistics['sum'] / $statistics['cnt'];
		}

		return $statistics;
	}
	/**
	 * Calculates value statistics from filtered records.
	 *
	 * @return  array  The list of statistics variables and values.
	 */
	public function getStatisticsValue()
	{
		$statistics['recs'] = 0;
		$statistics['cnt'] = 0;
		$statistics['sum'] = 0;
		$statistics['avg'] = 0;
		$statistics['max'] = 0;
		$statistics['min'] = null;

		foreach ($this->getItems() as $recordObject)
		{
			$statistics['recs'] += 1;

			if ($recordObject->value)
			{
				$statistics['cnt'] += 1;
				$statistics['sum'] += $recordObject->value;
				$statistics['max'] = max($recordObject->value, $statistics['max']);
				$statistics['min'] = min($recordObject->value, $statistics['min'] ?? $statistics['max']);
			}
		}

		if ($statistics['cnt'])
		{
			$statistics['avg'] = $statistics['sum'] / $statistics['cnt'];
		}

		return $statistics;
	}
}
