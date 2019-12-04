/**
 * @package    Joomla.Component
 * @copyright  (c) 2019 Libor Gabaj
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * @since      3.8
 */

/**
 * Update agenda tables
 */
ALTER TABLE `#__gbjfamily_expenses`
MODIFY COLUMN `date_on` date NOT NULL DEFAULT '0000-00-00',
ADD COLUMN `date_off` date NULL AFTER `date_on`
;
