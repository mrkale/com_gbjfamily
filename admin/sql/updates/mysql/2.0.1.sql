/**
 * @package    Joomla.Component
 * @copyright  (c) 2018 Libor Gabaj
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * @since      3.8
 */

/**
 * Update agenda tables
 */
CREATE TABLE IF NOT EXISTS `#__gbjfamily_incomes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `description` text,
  `date_on` date NOT NULL DEFAULT '0000-00-00',
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `price_orig` decimal(10,2) NOT NULL DEFAULT '0.00',
  `id_currency` int(11) NOT NULL DEFAULT '0',
  `id_domain` int(11) NOT NULL DEFAULT '0',
  `id_asset` int(11) NOT NULL DEFAULT '0',
  `state` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `params` text NOT NULL,
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(10) unsigned NOT NULL DEFAULT '0',
  `created_by_alias` varchar(255) NOT NULL DEFAULT '',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(10) unsigned NOT NULL DEFAULT '0',
  `metakey` text NOT NULL,
  `metadesc` text NOT NULL,
  `metadata` text NOT NULL,
  `featured` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `idx_date_on` (`date_on`),
  KEY `idx_checkout` (`checked_out`),
  KEY `idx_state` (`state`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
