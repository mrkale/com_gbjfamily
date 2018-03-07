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
 * Methods handling the record of an event.
 *
 * @since  3.7
 */
class GbjfamilyModelEvent extends GbjSeedModelAdmin
{
	/**
	 * Method to prepare and sanitize the table data prior to saving.
	 *
	 * @param   JTable  $table  A reference to a JTable object.
	 *
	 * @return  void
	 */
	protected function prepareTable($table)
	{
		parent::prepareTable($table);

		if ((float) $table->duration <= 0)
		{
			$table->duration = null;
		}
	}


	/**
	 * Batch setting stage to a list of items
	 *
	 * @param   string  $value     The id of the new value
	 * @param   array   $pks       An array of row IDs
	 * @param   array   $contexts  An array of item contexts
	 *
	 * @return  boolean Flag about table existence
	 */
	protected function batchStage($value, $pks, $contexts)
	{
		return $this->processBatch(__METHOD__, $value, $pks, $contexts);
	}

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
	 * Batch setting activity to a list of items
	 *
	 * @param   string  $value     The id of the new value
	 * @param   array   $pks       An array of row IDs
	 * @param   array   $contexts  An array of item contexts
	 *
	 * @return  boolean Flag about table existence
	 */
	protected function batchActivity($value, $pks, $contexts)
	{
		return $this->processBatch(__METHOD__, $value, $pks, $contexts);
	}
}
