<?php
/**
 * @package    Joomla.Administrator
 * @copyright  (c) 2020 Libor Gabaj
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * @since      3.8
 */

// No direct access
defined('_JEXEC') or die;


/**
 * Controller for an agenda export
 *
 * @since  3.8
 */
class GbjfamilyControllerDownload extends JControllerForm
{
	/**
	 * Method to export agenda content to CSV file.
	 *
	 * @return  void
	 */
	public function export()
	{
		$viewName = $this->input->get('view', '', 'word');
		$this->setRedirect(Helper::getUrlViewRaw($viewName));
	}
}
