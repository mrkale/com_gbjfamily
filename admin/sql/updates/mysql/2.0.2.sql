/**
 * @package    Joomla.Component
 * @copyright  (c) 2019 Libor Gabaj
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * @since      3.8
 */

/**
 * Update agenda tables
 */
ALTER TABLE `#__gbjfamily_incomes`
ADD COLUMN `id_project` int(11) NOT NULL DEFAULT '0'
AFTER `id_asset`;
