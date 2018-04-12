<?php
/**
 * @package    Joomla.Component
 * @copyright  (c) 2017 Libor Gabaj
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
class GbjfamilyTableVacation extends GbjSeedTable
{
	/**
	 * Method to perform sanity checks on the JTable instance properties to ensure they are safe to store in the database
	 *
	 * @return  boolean  True if the instance is sane and able to be stored in the database.
	 */
	public function check()
	{
		$this->checkDate('date_on');
		$this->checkDate('date_off');

		return parent::check();
	}

	/**
	 * Check the end date.
	 *
	 * @param   string $fieldName  The name of a field to be checked.
	 *
	 * @return void
	 */
	protected function checkDate($fieldName)
	{
		parent::checkDate($fieldName);

		// End date is sooner than start date
		if ($this->date_off < $this->date_on)
		{
			$errorMsg = JText::sprintf('COM_GBJFAMILY_ERROR_DATEOFF_LESS',
				JText::_('COM_GBJFAMILY_FIELD_VACATION_DATEOFF_LABEL'),
				JText::_('COM_GBJFAMILY_FIELD_VACATION_DATEON_LABEL')
			);
			$this->checkFlag = false;
			JFactory::getApplication()->enqueueMessage($errorMsg, 'error');
		}

		// End date is equal to start date
		if ($this->date_off == $this->date_on)
		{
			$errorMsg = JText::sprintf('COM_GBJFAMILY_ERROR_DATEOFF_EQUAL',
				JText::_('COM_GBJFAMILY_FIELD_VACATION_DATEOFF_LABEL'),
				JText::_('COM_GBJFAMILY_FIELD_VACATION_DATEON_LABEL'),
				JText::_('COM_GBJFAMILY_SUBMENU_EVENTS')
			);
			$this->checkFlag = false;
			JFactory::getApplication()->enqueueMessage($errorMsg, 'error');
		}
	}
}
