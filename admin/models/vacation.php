<?php
/**
 * @package    Joomla.Component
 * @copyright  (c) 2017 Libor Gabaj. All rights reserved.
 * @license    GNU General Public License version 2 or later. See LICENSE.txt, LICENSE.php.
 * @since      3.7
 */

// No direct access
defined('_JEXEC') or die;

/**
 * Methods handling the record of an vacation.
 *
 * @since  3.7
 */
class GbjfamilyModelVacation extends GbjSeedModelAdmin
{
	/**
	 * Batch setting stay to a list of items
	 *
	 * @param   string  $value     The id of the new value
	 * @param   array   $pks       An array of row IDs
	 * @param   array   $contexts  An array of item contexts
	 *
	 * @return  boolean Flag about table existence
	 */
	protected function batchStay($value, $pks, $contexts)
	{
		return $this->processBatch(__METHOD__, $value, $pks, $contexts);
	}

	/**
	 * Batch setting staff to a list of items
	 *
	 * @param   string  $value     The id of the new value
	 * @param   array   $pks       An array of row IDs
	 * @param   array   $contexts  An array of item contexts
	 *
	 * @return  boolean Flag about table existence
	 */
	protected function batchStaff($value, $pks, $contexts)
	{
		return $this->processBatch(__METHOD__, $value, $pks, $contexts);
	}
}
