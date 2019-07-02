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
 * Table definition for fact
 *
 * @since  3.8
 */
class GbjfamilyTableFact extends GbjSeedTable
{
	/**
	 * Method to perform sanity checks on the JTable instance properties to ensure they are safe to store in the database
	 *
	 * @return  boolean  True if the instance is sane and able to be stored in the database.
	 */
	public function check()
	{
		$this->checkTitle();

		return parent::check();
	}
}
