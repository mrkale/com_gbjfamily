<?php
/**
 * @package    Joomla.Component
 * @copyright  (c) 2019-2020 Libor Gabaj
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * @since      3.8
 */

// No direct access
defined('_JEXEC') or die;

/**
 * Methods handling the record of the expense.
 *
 * @since  3.8
 */
class GbjfamilyModelExpense extends GbjSeedModelAdmin
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
	 * Batch setting commodity to a list of items
	 *
	 * @param   string  $value     The id of the new value
	 * @param   array   $pks       An array of row IDs
	 * @param   array   $contexts  An array of item contexts
	 *
	 * @return  boolean Flag about table existence
	 */
	protected function batchCommodity($value, $pks, $contexts)
	{
		return $this->processBatch(__METHOD__, $value, $pks, $contexts);
	}

	/**
	 * Batch setting type to a list of items
	 *
	 * @param   string  $value     The id of the new value
	 * @param   array   $pks       An array of row IDs
	 * @param   array   $contexts  An array of item contexts
	 *
	 * @return  boolean Flag about table existence
	 */
	protected function batchType($value, $pks, $contexts)
	{
		return $this->processBatch(__METHOD__, $value, $pks, $contexts);
	}

	/**
	 * Batch setting unit to a list of items
	 *
	 * @param   string  $value     The id of the new value
	 * @param   array   $pks       An array of row IDs
	 * @param   array   $contexts  An array of item contexts
	 *
	 * @return  boolean Flag about table existence
	 */
	protected function batchUnit($value, $pks, $contexts)
	{
		return $this->processBatch(__METHOD__, $value, $pks, $contexts);
	}

	/**
	 * Batch setting vendor to a list of items
	 *
	 * @param   string  $value     The id of the new value
	 * @param   array   $pks       An array of row IDs
	 * @param   array   $contexts  An array of item contexts
	 *
	 * @return  boolean Flag about table existence
	 */
	protected function batchVendor($value, $pks, $contexts)
	{
		return $this->processBatch(__METHOD__, $value, $pks, $contexts);
	}

	/**
	 * Batch setting location to a list of items
	 *
	 * @param   string  $value     The id of the new value
	 * @param   array   $pks       An array of row IDs
	 * @param   array   $contexts  An array of item contexts
	 *
	 * @return  boolean Flag about table existence
	 */
	protected function batchLocation($value, $pks, $contexts)
	{
		return $this->processBatch(__METHOD__, $value, $pks, $contexts);
	}

	/**
	 * Batch setting project to a list of items
	 *
	 * @param   string  $value     The id of the new value
	 * @param   array   $pks       An array of row IDs
	 * @param   array   $contexts  An array of item contexts
	 *
	 * @return  boolean Flag about table existence
	 */
	protected function batchProject($value, $pks, $contexts)
	{
		return $this->processBatch(__METHOD__, $value, $pks, $contexts);
	}

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

		// Calculate additional data
		$table->period = Helper::calculatePeriodDays($table->date_on, $table->date_off);
		$table->lifespan = Helper::calculatePeriodDays(
			Helper::getProperDate($table->date_off, $table->date_on),
			$table->date_out
		);

		if ($table->quantity == 1 || $table->quantity == 0)
		{
			$table->price_unit = null;
		}
		else
		{
			$table->price_unit = $table->price / $table->quantity;
		}
	}
}
