<?php
/**
 * @package    Joomla.Component
 * @copyright  (c) 2017 Libor Gabaj. All rights reserved.
 * @license    GNU General Public License version 2 or later. See LICENSE.txt, LICENSE.php.
 * @since      3.7
 */

// No direct access
defined('_JEXEC') or die;

/**
 * Table definition for event
 *
 * @since  3.7
 */
class GbjfamilyTableDevice extends GbjSeedTable
{
	/**
	 * Method to perform sanity checks on the JTable instance properties to ensure they are safe to store in the database
	 *
	 * @return  boolean  True if the instance is sane and able to be stored in the database.
	 */
	public function check()
	{
		$this->checkAlias();
		$this->checkSerial();
		$this->checkMac('eth_mac');
		$this->checkIp4('eth_ip4');
		$this->checkMac('wifi_mac');
		$this->checkIp4('wifi_ip4');

		return parent::check();
	}

	/**
	 * Check the validity of the alias field.
	 *
	 * @param   string $fieldName  The name of a field to be checked.
	 *
	 * @return void
	 */
	protected function checkAlias($fieldName = 'alias')
	{
		if (empty($this->${fieldName}))
		{
			return;
		}

		$primaryKeyName = $this->getKeyName();
		$table = clone $this;

		// Uniqueness
		if ($table->load(array($fieldName => $this->${fieldName}))
			&& (isset($primaryKeyName)
			&& ($table->{$primaryKeyName} != $this->{$primaryKeyName}
			|| $this->{$primaryKeyName} == 0)))
		{
			JFactory::getApplication()->enqueueMessage(JText::_('COM_GBJFAMILY_ERROR_UNIQUE_HOSTNAME'), 'warning');
		}
	}

	/**
	 * Check the validity of the serial number field.
	 *
	 * @param   string $fieldName  The name of a field to be checked.
	 *
	 * @return void
	 */
	protected function checkSerial($fieldName = 'serial')
	{
		if (empty($this->${fieldName}))
		{
			return;
		}

		$primaryKeyName = $this->getKeyName();
		$table = clone $this;

		// Uniqueness
		if ($table->load(array($fieldName => $this->${fieldName}))
			&& (isset($primaryKeyName)
			&& ($table->{$primaryKeyName} != $this->{$primaryKeyName}
			|| $this->{$primaryKeyName} == 0)))
		{
			$this->checkFlag = false;
			JFactory::getApplication()->enqueueMessage(JText::_('COM_GBJFAMILY_ERROR_UNIQUE_SERIAL'), 'error');
		}
	}

	/**
	 * Check the validity of the IPv4 address field.
	 *
	 * @param   string $fieldName  The name of a field to be checked.
	 *
	 * @return void
	 */
	protected function checkIp4($fieldName)
	{
		if (empty($this->${fieldName}))
		{
			return;
		}

		$primaryKeyName = $this->getKeyName();
		$table = clone $this;
		$boolResult = false;

		$ifcs = array('eth', 'wifi');

		foreach ($ifcs as $i => $ifc)
		{
			$pattern = '/^' . $ifc . '/';

			if (preg_match($pattern, $fieldName))
			{
				$fieldComplement = preg_replace($pattern, $ifcs[($i + 1) % 2], $fieldName);
				$errorConst = str_replace('#', strtoupper($ifc), 'COM_GBJFAMILY_FIELD_DEVICE_#IP4_LABEL');
				break;
			}
		}

		// Unique withing row
		if (!$boolResult)
		{
			$boolResult = $this->${fieldName} === $this->${$fieldComplement};
		}

		// Unique withing column
		if (!$boolResult)
		{
			$boolResult = $table->load(array($fieldName => $this->${fieldName}))
				&& (isset($primaryKeyName)
					&& ($table->{$primaryKeyName} != $this->{$primaryKeyName}
					|| $this->{$primaryKeyName} == 0));
		}

		// Unique withing counterpart column
		if (!$boolResult)
		{
			$boolResult = $table->load(array($fieldComplement => $this->${fieldName}));
		}

		if ($boolResult)
		{
			$errorMsg = JText::sprintf('COM_GBJFAMILY_ERROR_ADDRESS_DOUBLE', JText::_($errorConst));
			JFactory::getApplication()->enqueueMessage($errorMsg, 'warning');
		}

		// Valid
		if (filter_var($this->${fieldName}, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) !== $this->${fieldName})
		{
			$this->checkFlag = false;
			$errorMsg = JText::sprintf('COM_GBJFAMILY_ERROR_ADDRESS_WRONG', JText::_($errorConst));
			JFactory::getApplication()->enqueueMessage($errorMsg, 'error');
		}

		// Private
		if (filter_var($this->${fieldName}, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE) === $this->${fieldName})
		{
			$this->checkFlag = false;
			$errorMsg = JText::sprintf('COM_GBJFAMILY_ERROR_ADDRESS_PUBLIC', JText::_($errorConst));
			JFactory::getApplication()->enqueueMessage($errorMsg, 'error');
		}
	}

	/**
	 * Check the validity of the MAC address field.
	 *
	 * @param   string $fieldName  The name of a field to be checked.
	 *
	 * @return void
	 */
	protected function checkMac($fieldName)
	{
		if (empty($this->${fieldName}))
		{
			return;
		}

		$primaryKeyName = $this->getKeyName();
		$table = clone $this;
		$boolResult = false;

		$ifcs = array('eth', 'wifi');

		foreach ($ifcs as $i => $ifc)
		{
			$pattern = '/^' . $ifc . '/';

			if (preg_match($pattern, $fieldName))
			{
				$fieldComplement = preg_replace($pattern, $ifcs[($i + 1) % 2], $fieldName);
				$errorConst = str_replace('#', strtoupper($ifc), 'COM_GBJFAMILY_FIELD_DEVICE_#MAC_LABEL');
				break;
			}
		}

		// Unique withing row
		if (!$boolResult)
		{
			$boolResult = $this->${fieldName} === $this->${$fieldComplement};
		}

		// Unique withing column
		if (!$boolResult)
		{
			$boolResult = $table->load(array($fieldName => $this->${fieldName}))
				&& (isset($primaryKeyName)
					&& ($table->{$primaryKeyName} != $this->{$primaryKeyName}
					|| $this->{$primaryKeyName} == 0));
		}

		// Unique withing counterpart column
		if (!$boolResult)
		{
			$boolResult = $table->load(array($fieldComplement => $this->${fieldName}));
		}

		if ($boolResult)
		{
			$errorMsg = JText::sprintf('COM_GBJFAMILY_ERROR_ADDRESS_DOUBLE', JText::_($errorConst));
			JFactory::getApplication()->enqueueMessage($errorMsg, 'warning');
		}

		// Valid
		if (filter_var($this->${fieldName}, FILTER_VALIDATE_MAC) !== $this->${fieldName})
		{
			$this->checkFlag = false;
			$errorMsg = JText::sprintf('COM_GBJFAMILY_ERROR_ADDRESS_WRONG', JText::_($errorConst));
			JFactory::getApplication()->enqueueMessage($errorMsg, 'error');
		}
	}
}
