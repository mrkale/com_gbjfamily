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
	 * Check the validity of the alias field.
	 *
	 * @param   string $fieldName  The name of a field to be checked.
	 *
	 * @return void
	 */
	protected function checkAlias($fieldName = 'alias')
	{
		// Field is not used
		if (!isset($this->$fieldName) || empty($this->$fieldName))
		{
			return;
		}

		$primaryKeyName = $this->getKeyName();
		$fieldTitle = 'title';
		$fieldDomain = 'id_domain';

		if ($this->isDuplicateRecord(
			array($fieldName => $this->$fieldName,
				  $fieldTitle => $this->$fieldTitle,
				  $fieldDomain => $this->$fieldDomain),
			array($primaryKeyName => $this->$primaryKeyName)
		))
		{
			$errorMsg = JText::_('COM_GBJFAMILY_ERROR_UNIQUE_FACT');
			JFactory::getApplication()->enqueueMessage($errorMsg, 'error');
		}
	}
}
