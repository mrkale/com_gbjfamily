/**
 * @package    Joomla.Component
 * @copyright  (c) 2019-2020 Libor Gabaj
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * @since      3.8
 */

/**
 * Update agenda tables
 */
ALTER TABLE `#__gbjfamily_devices`
DROP COLUMN IF EXISTS `type`,
DROP COLUMN IF EXISTS `eth_ifc`,
DROP COLUMN IF EXISTS `wifi_ifc`,
DROP COLUMN IF EXISTS `id_port`;
