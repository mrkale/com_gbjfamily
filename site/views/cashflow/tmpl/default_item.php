<?php
/**
 * @package    Joomla.Component
 * @copyright  (c) 2019 Libor Gabaj
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * @since      3.8
 */

// No direct access
defined('_JEXEC') or die;

$layoutBasePath = Helper::getLayoutBase();
$tparams = $this->params;
$pageclass_sfx = htmlspecialchars($tparams->get('pageclass_sfx'));
$class = strtolower(Helper::getClassPrefix()). '_dl' . $pageclass_sfx;

$this->item->price_month = $this->item->price_month ?? $this->item->price;
?>
<dl class="<?php echo $class; ?>">
	<?php echo JLayoutHelper::render('record.field', $this, $layoutBasePath, array('field'=>'period')); ?>
	<?php echo JLayoutHelper::render('record.field', $this, $layoutBasePath, array('field'=>'price')); ?>
	<?php echo JLayoutHelper::render('record.field', $this, $layoutBasePath, array('field'=>'price_month')); ?>
	<?php echo JLayoutHelper::render('record.field', $this, $layoutBasePath, array('field'=>'iban')); ?>
	<?php echo JLayoutHelper::render('record.field', $this, $layoutBasePath, array('field'=>'varsymb')); ?>
	<?php echo JLayoutHelper::render('record.field', $this, $layoutBasePath, array('field'=>'specsymb')); ?>
	<?php echo JLayoutHelper::render('record.field', $this, $layoutBasePath, array('field'=>'billspan')); ?>
	<?php echo JLayoutHelper::render('record.field', $this, $layoutBasePath, array('field'=>'payspan')); ?>
	<?php echo JLayoutHelper::render('record.field', $this, $layoutBasePath, array('field'=>'id_domain')); ?>
	<?php echo JLayoutHelper::render('record.field', $this, $layoutBasePath, array('field'=>'id_vendor')); ?>
	<?php echo JLayoutHelper::render('record.field', $this, $layoutBasePath, array('field'=>'id_payform')); ?>
</dl>
