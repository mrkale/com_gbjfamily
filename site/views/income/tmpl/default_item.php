<?php
/**
 * @package    Joomla.Component
 * @copyright  (c) 2018 Libor Gabaj
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * @since      3.8
 */

// No direct access
defined('_JEXEC') or die;

$layoutBasePath = Helper::getLayoutBase();
$tparams = $this->params;
$pageclass_sfx = htmlspecialchars($tparams->get('pageclass_sfx'));
$class = strtolower(Helper::getClassPrefix()). '_dl' . $pageclass_sfx;

$this->item->price = number_format($this->item->price,
	JText::_('COM_GBJFAMILY_FORMAT_NUMBER_DECIMALS'),
	JText::_('COM_GBJFAMILY_FORMAT_NUMBER_SEPARATOR_DECIMALS'),
	JText::_('COM_GBJFAMILY_FORMAT_NUMBER_SEPARATOR_THOUSANDS')
);

if (isset($this->item->price_orig))
{
	$this->item->price_orig = number_format($this->item->price_orig,
		JText::_('COM_GBJFAMILY_FORMAT_NUMBER_DECIMALS'),
		JText::_('COM_GBJFAMILY_FORMAT_NUMBER_SEPARATOR_DECIMALS'),
		JText::_('COM_GBJFAMILY_FORMAT_NUMBER_SEPARATOR_THOUSANDS')
	);
}
?>
<dl class="<?php echo $class; ?>">
	<?php echo JLayoutHelper::render('record.field', $this, $layoutBasePath, array('field'=>'date_on')); ?>
	<?php echo JLayoutHelper::render('record.field', $this, $layoutBasePath, array('field'=>'price')); ?>
	<?php echo JLayoutHelper::render('record.field', $this, $layoutBasePath, array('field'=>'price_orig')); ?>
	<?php echo JLayoutHelper::render('record.field', $this, $layoutBasePath, array('field'=>'id_domain')); ?>
	<?php echo JLayoutHelper::render('record.field', $this, $layoutBasePath, array('field'=>'id_asset')); ?>
</dl>
