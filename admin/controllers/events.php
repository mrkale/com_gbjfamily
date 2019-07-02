<?php
/**
 * @package    Joomla.Component
 * @copyright  (c) 2017-2018 Libor Gabaj
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * @since      3.8
 */

// No direct access
defined('_JEXEC') or die;

/**
 * Methods supporting a list of events
 *
 * @since  3.8
 */
class GbjfamilyControllerEvents extends GbjSeedControllerAdmin
{
	/**
	 * Method to leave the current agenda and return to projects.
	 *
	 * @return  void
	 */
	public function enterProjects()
	{
		$this->enterAgendaParent(__FUNCTION__);
	}
}
