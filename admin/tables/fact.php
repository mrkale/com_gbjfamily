<?php
/**
 * @package    Joomla.Component
 * @copyright  (c) 2019-2021 Libor Gabaj
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
	 * Object constructor to set table and key fields.
	 *
	 * @param   JDatabaseDriver  $db     JDatabaseDriver object.
	 * @param   string           $table  Name of the table to model.
	 * @param   mixed            $key    Name of the primary key field in the table or array of field names that compose the primary key.
	 *
	 * @since   11.1
	 */
	public function __construct($db, $table = null, $key = null)
	{
		$this->checkIgnores = array('Alias');

		return parent::__construct($db, $table, $key);
	}
}
