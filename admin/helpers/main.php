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
 * Definition of constants and methods specific for an extension.
 *
 * @since  3.7
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
