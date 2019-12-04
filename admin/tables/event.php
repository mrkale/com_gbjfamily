<?php
/**
 * @package    Joomla.Component
 * @copyright  (c) 2017-2019 Libor Gabaj
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * @since      3.8
 */

// No direct access
defined('_JEXEC') or die;

/**
 * Table definition for agenda
 *
 * @since  3.8
 */
class GbjfamilyTableEvent extends GbjSeedTable
{
	/**
	 * Method to perform sanity checks on the JTable instance properties to ensure they are safe to store in the database
	 *
	 * @return  boolean  True if the instance is sane and able to be stored in the database.
	 */
	public function check()
	{
		$this->checkDuration();
		$this->checkQuantity('turn');

		return parent::check();
	}

	/**
	 * Check the duration.
	 *
	 * Do not enqueue errors, just set the first one.
	 * In contrast, enqueue other types of messages, e.g., warnings.
	 *
	 * @param   string $fieldName  The name of a field to be checked.
	 *
	 * @return void
	 */
	protected function checkDuration($fieldName = 'duration')
	{
		if (!is_numeric($this->$fieldName))
		{
			return;
		}

		// Duration should be positive
		if ((float) $this->$fieldName <= 0)
		{
			$this->raiseError($fieldName, 'COM_GBJFAMILY_ERROR_NONPOSITIVE_DURATION');
		}

		// Duration should be at most one day
		if ((float) $this->$fieldName > 24)
		{
			$this->raiseError($fieldName, 'COM_GBJFAMILY_ERROR_TOOBIG_DURATION');
		}
	}
}
