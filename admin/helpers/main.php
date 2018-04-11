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
 * Definition of constants and methods specific for an extension.
 *
 * @since  3.8
 */
class Helper extends GbjHelpersCommon
{
	// Default view
	const HELPER_DEFAULT_VIEW = 'events';

	// Codebook table prefix
	const HELPER_CODEBOOK_TABLE_PREFIX = 'gbjcodes';

	/**
	 * List of views in the side bar sub menu
	 *
	 * @var array
	 */
	protected static $helperViewsInSubmenu = array(
		'events',
		'vacations',
		'devices',
	);
}
