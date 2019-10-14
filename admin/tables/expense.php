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
 * Table definition for expense
 *
 * @since  3.8
 */
class GbjfamilyTableExpense extends GbjSeedTable
{
	/**
	 * Method to perform sanity checks on the JTable instance properties to ensure they are safe to store in the database
	 *
	 * @return  boolean  True if the instance is sane and able to be stored in the database.
	 */
	public function check()
	{
		$this->checkQuantity('quantity');
		$this->checkPrice('price');
		$this->checkPrice('price_orig');

		$this->errorMsgs['date_on.date_out'] = JText::sprintf('LIB_GBJ_ERROR_DATES_LESS',
			JText::_('COM_GBJFAMILY_FIELD_EXPENSE_DATEOUT_LABEL'),
			JText::_('COM_GBJFAMILY_FIELD_EXPENSE_DATEON_LABEL'));
		$this->checkDatesReverse('date_on', 'date_out');

		$this->errorMsgs['date_off.date_out'] = JText::sprintf('LIB_GBJ_ERROR_DATES_LESS',
			JText::_('COM_GBJFAMILY_FIELD_EXPENSE_DATEOUT_LABEL'),
			JText::_('COM_GBJFAMILY_FIELD_EXPENSE_DATEOFF_LABEL'));
		$this->checkDatesReverse('date_off', 'date_out');

		$this->errorMsgs['date_on.date_off'] = JText::sprintf('LIB_GBJ_ERROR_DATES_LESS',
			JText::_('COM_GBJFAMILY_FIELD_EXPENSE_DATEOFF_LABEL'),
			JText::_('COM_GBJFAMILY_FIELD_EXPENSE_DATEON_LABEL'));

		return parent::check();
	}
}
