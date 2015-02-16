--TEST--
MongoDB::listCollections() Run against primary (legacy mode)
--SKIPIF--
<?php $needs = "2.7.5"; $needsOp = "lt"; ?>
<?php require_once 'tests/utils/replicaset.inc' ?>
--FILE--
<?php
require_once 'tests/utils/server.inc';

$rs = MongoShellServer::getReplicaSetInfo();
$dsn = MongoShellServer::getASecondaryNode();
$m = new MongoClient($dsn, array('replicaSet' => $rs['rsname']));
$d = $m->selectDB(dbname());

MongoLog::setModule( MongoLog::ALL );
MongoLog::setLevel( MongoLog::ALL );
MongoLog::setCallback( function($a, $b, $c) {
	static $foundPick = 0;
	
	if (preg_match('/finding.*\(read\)/', $c)) {
		$foundPick = 1;
	}
	if ($foundPick == 1 && preg_match('/^pick server/', $c)) {
		$foundPick = 2;
	}
	if ($foundPick == 2 && preg_match('/type:/', $c)) {
		echo $c, "\n";
	}
} );

$l = $d->listCollections();
?>
DONE
--EXPECTF--
- connection: type: PRIMARY, socket: %d, ping: %d, hash: %s:%d;%s;.;%d
DONE
