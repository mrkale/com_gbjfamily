/**
 * @package    Joomla.Component
 * @copyright  (c) 2019 Libor Gabaj
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * @since      3.8
 */

/**
 * Update agenda tables
 */
ALTER TABLE `#__gbjfamily_facts`
MODIFY COLUMN `date_on` date NOT NULL DEFAULT '0000-00-00',
MODIFY COLUMN `date_off` date NOT NULL DEFAULT '0000-00-00'
;
ALTER TABLE `#__gbjfamily_fuels`
MODIFY COLUMN `date_on` date NOT NULL DEFAULT '0000-00-00'
;
ALTER TABLE `#__gbjfamily_vacations`
ADD COLUMN `period` int(11) NOT NULL DEFAULT '0' AFTER `date_off`
;
ALTER TABLE `#__gbjfamily_expenses`
MODIFY COLUMN `date_off` date NOT NULL DEFAULT '0000-00-00',
ADD COLUMN `period` int(11) NULL AFTER `date_off`
;
