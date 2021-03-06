--TEST--
Test for bug #843: Text output depends on php locale.
--SKIPIF--
<?php if (false == setlocale(LC_ALL, "de_DE.UTF-8", "de_DE", "de", "german", "ge", "de_DE.ISO-8859-1")) print "skip locale with , not found"; ?>
--INI--
xdebug.enable=1
xdebug.auto_trace=0
xdebug.collect_params=3
xdebug.collect_return=0
xdebug.collect_assignments=0
xdebug.auto_profile=0
xdebug.profiler_enable=0
xdebug.show_mem_delta=0
xdebug.trace_format=1
--FILE--
<?php
$tf = xdebug_start_trace('/tmp/'. uniqid('xdt', TRUE));

setlocale(LC_ALL, "ro_RO.UTF-8", "de_DE.UTF-8", "de_DE", "de", "german", "ge", "de_DE.ISO-8859-1");

xdebug_stop_trace();
echo file_get_contents($tf);
unlink($tf);
?>
--EXPECTF--
Version: 3.%s
File format: %d
TRACE START [%d-%d-%d %d:%d:%d]
2	2	1	%d.%d	%d
2	3	0	%d.%d	%d	setlocale	0		%sbug00843.php	4	%d	6	'%s'
2	3	1	%d.%d	%d
2	4	0	%d.%d	%d	xdebug_stop_trace	0		%sbug00843.php	6	0
			%d.%d	%d
TRACE END   [%d-%d-%d %d:%d:%d]
