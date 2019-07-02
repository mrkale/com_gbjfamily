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
 * Methods handling the record of the asset.
 *
 * @since  3.8
 */
class GbjfamilyModelAsset extends GbjSeedModelAdmin
{
	/**
	 * Batch setting domain to a list of items
	 *
	 * @param   string  $value     The id of the new value
	 * @param   array   $pks       An array of row IDs
	 * @param   array   $contexts  An array of item contexts
	 *
	 * @return  boolean Flag about table existence
	 */
	protected function batchDomain($value, $pks, $contexts)
	{
		return $this->processBatch(__METHOD__, $value, $pks, $contexts);
	}

	/**
	 * Batch setting currency to a list of items
	 *
	 * @param   string  $value     The id of the new value
	 * @param   array   $pks       An array of row IDs
	 * @param   array   $contexts  An array of item contexts
	 *
	 * @return  boolean Flag about table existence
	 */
	protected function batchCurrency($value, $pks, $contexts)
	{
		return $this->processBatch(__METHOD__, $value, $pks, $contexts);
	}

	/**
	 * Batch setting asset to a list of items
	 *
	 * @param   string  $value     The id of the new value
	 * @param   array   $pks       An array of row IDs
	 * @param   array   $contexts  An array of item contexts
	 *
	 * @return  boolean Flag about table existence
	 */
	protected function batchAsset($value, $pks, $contexts)
	{
		return $this->processBatch(__METHOD__, $value, $pks, $contexts);
	}
}
