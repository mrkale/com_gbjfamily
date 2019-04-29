<?php
/**
 * @package    Joomla.Component
 * @copyright  (c) 2018-2019 Libor Gabaj
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * @since      3.8
 */

// No direct access
defined('_JEXEC') or die;

/**
 * Methods supporting a list of vacations
 *
 * @since  3.8
 */
class GbjfamilyControllerProjects extends GbjSeedControllerAdmin
{
	/**
	 * Method to enter the expenses agenda.
	 *
	 * @return  void
	 */
	public function enterExpenses()
	{
		$this->enterAgendaChild(__FUNCTION__);
	}

	/**
	 * Method to enter the events agenda.
	 *
	 * @return  void
	 */
	public function enterEvents()
	{
		$this->enterAgendaChild(__FUNCTION__);
	}

	/**
	 * Method to enter the events agenda.
	 *
	 * @return  void
	 */
	public function enterIncomes()
	{
		$this->enterAgendaChild(__FUNCTION__);
	}
}
