<?php
/**
 * @package    Joomla.Component
 * @copyright  (c) 2017-2018 Libor Gabaj
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
class GbjfamilyModelEvents extends GbjSeedModelList
{
	/**
	 * Calculates statistics from filtered records.
	 *
	 * @return  array  The list of statistics variables and values.
	 */
	public function getStatistics()
	{
		$statistics['duration']['cnt'] = 0;
		$statistics['duration']['sum'] = 0;
		$statistics['duration']['avg'] = 0;
		$statistics['duration']['max'] = 0;
		$statistics['duration']['min'] = null;

		foreach ($this->getItems() as $recordObject)
		{
			if (!is_null($recordObject->duration))
			{
				$statistics['duration']['cnt'] += 1;
				$statistics['duration']['sum'] += $recordObject->duration;
				$statistics['duration']['max'] = max($recordObject->duration, $statistics['duration']['max']);
				$statistics['duration']['min'] = min($recordObject->duration, $statistics['duration']['min'] ?? $statistics['duration']['max']);
			}
		}

		if ($statistics['duration']['cnt'] <> 0)
		{
			$statistics['duration']['avg'] = $statistics['duration']['sum'] / $statistics['duration']['cnt'];
		}

		return $statistics;
	}
}
