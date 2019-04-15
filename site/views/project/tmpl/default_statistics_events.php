<?php
/**
 * @package    Joomla.Component
 * @copyright  (c) 2018-2019 Libor Gabaj
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * @since      3.8
 */

// No direct access
defined('_JEXEC') or die;

$layoutBasePath = Helper::getLayoutBase();
$tparams = $this->params;
$pageclass_sfx = htmlspecialchars($tparams->get('pageclass_sfx'));

$statistics = $this->statistics['events'];
?>
<dl class="gbjfamily_dl<?php echo $pageclass_sfx; ?>">
	<?php echo JLayoutHelper::render('record.statistics', $this, $layoutBasePath, array('statistics'=>$statistics)); ?>
</dl>
