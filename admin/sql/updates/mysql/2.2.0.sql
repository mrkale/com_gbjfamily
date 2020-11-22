/**
 * @package    Joomla.Component
 * @copyright  (c) 2020 Libor Gabaj
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * @since      3.8
 */

/**
 * Update agenda tables
 */
ALTER TABLE `#__gbjfamily_facts`
ADD COLUMN `id_unit` int(11) NOT NULL DEFAULT '0' AFTER `period`;
