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
 * Methods handling the record of the fuel.
 *
 * @since  3.8
 */
class GbjfamilyModelFuel extends GbjSeedModelAdmin
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
		$cparams = JComponentHelper::getParams(Helper::getName());
		$recentFuellings = intval($cparams->get('consumption_fuellings', 1));
		$app = JFactory::getApplication();
		$db = $this->getDbo();
		$tableName = $table->getTableName();
		$query = $db->getQuery(true)
			->select('date_on, quantity, tacho, distance')
			->from($db->quoteName($tableName))
			->where('id_domain = ' . $table->id_domain)
			->where('state IN (0, 1, 2)')	// Unpublished, published, archived
			->where('tacho < ' . $table->tacho)
			->order('tacho DESC')
			->setLimit($recentFuellings);
		$db->setQuery($query);

		try
		{
			$previousRecords = $db->loadObjectList();
		}
		catch (RuntimeException $e)
		{
			$app->enqueueMessage($e->getMessage(), 'error');
		}

		$table->period = null;
		$table->distance = null;
		$table->consumption = null;

		if (isset($previousRecords))
		{
			// Calculate data for previous fuelling
			$previousRecord = $previousRecords[0];

			if (isset($previousRecord->date_on))
			{
				$jdate = new JDate($table->date_on);
				$dateStart = $jdate->toUnix();
				$jdate = new JDate($previousRecord->date_on);
				$dateStop = $jdate->toUnix();
				$table->period = ($dateStart - $dateStop) / 86400;
			}

			if (isset($previousRecord->tacho))
			{
				$table->distance = $table->tacho - $previousRecord->tacho;
			}

			// Calculate consumption from last n-1 records
			$quantity = $table->quantity;
			$distance = $table->distance;
			$maxRecords = $recentFuellings - 2;

			foreach ($previousRecords as $i => $previousRecord)
			{
				if ($i > $maxRecords)
				{
					break;
				}

				$quantity += $previousRecord->quantity ?? 0;
				$distance += $previousRecord->distance ?? 0;
			}

			if (isset($quantity) && $distance != 0)
			{
				$table->consumption = $quantity * 100 / $distance;
			}
		}
	}
}
