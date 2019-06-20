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
		$fieldList = array('price', 'value');

		return $this->getFilterStatistics($fieldList);
	}
}
