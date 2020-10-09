/*
@package    Joomla.Component
@copyright  (c) 2020 Libor Gabaj. All rights reserved.
@license    GNU General Public License version 2 or later. See LICENSE.txt, LICENSE.php.
@since      3.8
*/
RawFormatSubmitbutton = function (task) {
	var admform = document.forms['adminForm'];
	if (admform == null) {
		alert('no adminForm defined');
		return;
	}
	// Force RAW format
	var fmt = admform.elements.namedItem('format');
	if ((fmt == null) || (fmt.tagName != 'INPUT')) {
		fmt = document.createElement('input');
		admform.appendChild(fmt);
		fmt.name = 'format';
		fmt.type = 'hidden';
		oldfmt = 'html';
	} else {
		oldfmt = fmt.value;
	}
	fmt.value = 'raw';
	Joomla.submitform(task);
	fmt.value = oldfmt;
	// Reset task
	var tsk = admform.elements.namedItem('task');
	if ((tsk == null) || (tsk.tagName != 'INPUT')) {
		tsk = document.createElement('input');
		admform.appendChild(tsk);
		tsk.name = 'task';
		tsk.type = 'hidden';
	}
	tsk.value = '';
}
