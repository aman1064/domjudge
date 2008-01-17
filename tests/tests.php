#!/usr/bin/php -q
<?php
/**
 * A web application, daemons or database-based applications are not easily
 * automatically testable.
 * This file tries to test some of the more basic input-output functions
 * of DOMjudge.
 */

$done=$failed=0;

function t($n, $t, $r)
{
	global $done, $failed;

	echo "TEST $n: ";
	$done++;
	if ( $t === $r ) {
		echo "OK\n";
	} else {
		echo "FAIL\n";
		$failed++;
		var_dump($t);
		var_dump($r);
	}
}

require('../lib/lib.misc.php');

t('IP1', compareipaddr('127.0.0.1','127.0.0.1'), TRUE);
t('IP2', compareipaddr('127.0.0.1','127.0.0.2'), FALSE);
t('IP3', compareipaddr('127.0.0.1','127.0.0.'), FALSE);
t('IP4', compareipaddr('127.0.0.1','127.0.0.1 '), FALSE);

require('../www/print.php');

t('printyn1', printyn(true), 'yes');
t('printyn2', printyn(false), 'no');
t('printyn3', printyn(1), 'yes');
t('printyn4', printyn(0), 'no');

t('printtime1', printtime(now()), date('H:i'));

require('../www/jury/checkers.php');

t('datetime1', check_datetime(now()), now());


exit($failed);
