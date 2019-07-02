/**
 * @package    Joomla.Component
 * @copyright  (c) 2018 Libor Gabaj
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * @since      3.8
 */

/**
 * Update agenda tables
 */
ALTER TABLE `#__gbjfamily_events`
ADD COLUMN `id_project` int(11) NOT NULL DEFAULT '0'
AFTER `id_stage`;


CREATE TABLE IF NOT EXISTS `#__gbjfamily_projects` (
  `id` integer NOT NULL auto_increment,
  `title` varchar(255) NOT NULL default '',
  `alias` varchar(30) NOT NULL default '',
  `description` text,
  `id_domain` int(11) NOT NULL DEFAULT '0',
  `state` tinyint(1) NOT NULL default '0',
  `checked_out` integer unsigned NOT NULL default '0',
  `checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `params` text NOT NULL,
  `created` datetime NOT NULL default '0000-00-00 00:00:00',
  `created_by` int(10) unsigned NOT NULL default '0',
  `created_by_alias` varchar(255) NOT NULL default '',
  `modified` datetime NOT NULL default '0000-00-00 00:00:00',
  `modified_by` int(10) unsigned NOT NULL default '0',
  `metakey` text NOT NULL,
  `metadesc` text NOT NULL,
  `metadata` text NOT NULL,
  `featured` tinyint(1) unsigned NOT NULL default '0',
  `publish_up` datetime NOT NULL default '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `idx_checkout` (`checked_out`),
  KEY `idx_state` (`state`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
