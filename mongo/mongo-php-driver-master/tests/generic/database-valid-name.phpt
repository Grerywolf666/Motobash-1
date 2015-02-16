--TEST--
Database: valid name checks
--SKIPIF--
<?php require_once "tests/utils/standalone.inc"; ?>
--FILE--
<?php
require_once "tests/utils/server.inc";
$a = mongo_standalone();
$names = array("\\", "\$", "/", "foo.bar");
foreach ($names as $name) {
	try {
		$d = new MongoDB($a, $name);
	} catch (Exception $e) {
		echo $name, ": ", $e->getMessage(), "\n";
	}
}
?>
--EXPECT--
\: Database name contains invalid characters: \
$: Database name contains invalid characters: $
/: Database name contains invalid characters: /
foo.bar: Database name contains invalid characters: foo.bar
