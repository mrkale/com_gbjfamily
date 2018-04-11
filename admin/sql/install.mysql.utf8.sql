/**
 * @package    Joomla.Component
 * @copyright  (c) 2017 Libor Gabaj
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * @since      3.8
 */

/**
 * Create tables for the component.
 */
CREATE TABLE IF NOT EXISTS `#__gbjfamily_events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `description` text,
  `date_on` date NOT NULL DEFAULT '0000-00-00' COMMENT 'Date of an event.',
  `duration` decimal(4,2) NULL COMMENT 'Duration of the event in hours.',
  `id_domain` int(11) NOT NULL DEFAULT '0' COMMENT 'Domains codebook id.',
  `id_activity` int(11) NOT NULL DEFAULT '0' COMMENT 'Activities codebook id.',
  `id_stage` int(11) NOT NULL DEFAULT '0' COMMENT 'Stages codebook id.',
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

CREATE TABLE IF NOT EXISTS `#__gbjfamily_devices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT 'Role of the device at home.',
  `alias` varchar(30) NOT NULL default '' COMMENT 'Hostname in the network.',
  `description` text,
  `brandname` varchar(30) NOT NULL default '' COMMENT 'Original brand name of the device.',
  `serial` varchar(30) NOT NULL default '' COMMENT 'Serial number.',
  `type` varchar(30) NOT NULL default '' COMMENT 'Device type identified by a router.',
  `eth_mac` varchar(30) NOT NULL default '' COMMENT 'MAC address for ethernet interface.',
  `eth_ip4` varchar(15) NOT NULL default '' COMMENT 'IPv4 address for ethernet interface.',
  `eth_ifc` varchar(30) NOT NULL default '' COMMENT 'Ethernet hardware interface.',
  `wifi_mac` varchar(17) NOT NULL default '' COMMENT 'MAC address for wireless interface.',
  `wifi_ip4` varchar(15) NOT NULL default '' COMMENT 'IPv4 address for wireless interface.',
  `wifi_ifc` varchar(30) NOT NULL default '' COMMENT 'Wireless hardware interface.',
  `id_network` int(11) NOT NULL DEFAULT '0' COMMENT 'Codebook ID of a network in which the device is connected.',
  `id_port` int(11) NOT NULL DEFAULT '0' COMMENT 'Codebook ID of a router port reported by a router.',
  `id_device` int(11) NOT NULL DEFAULT '0' COMMENT 'Codebook ID of device brand category.',
  `id_vendor` int(11) NOT NULL DEFAULT '0' COMMENT 'Codebook ID of a vendor producing the device.',
  `id_location` int(11) NOT NULL DEFAULT '0' COMMENT 'Codebook ID of a locations where the device is placed.',
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
  KEY `idx_checkout` (`checked_out`),
  KEY `idx_state` (`state`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `#__gbjfamily_vacations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `description` text,
  `date_on` date NOT NULL DEFAULT '0000-00-00' COMMENT 'Start date of a stay.',
  `date_off` date NOT NULL DEFAULT '0000-00-00' COMMENT 'End date of a stay.',
  `id_stay` int(11) NOT NULL DEFAULT '0' COMMENT 'Stays codebook id.',
  `id_staff` int(11) NOT NULL DEFAULT '0' COMMENT 'Staffs codebook id.',
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
