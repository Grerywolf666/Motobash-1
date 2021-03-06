--TEST--
MongoCollection::getIndexInfo() Run against secondary directly with RP secondary (legacy mode)
--SKIPIF--
<?php $needs = "2.7.5"; $needsOp = "lt"; ?>
<?php require_once 'tests/utils/replicaset.inc' ?>
--FILE--
<?php
require_once 'tests/utils/server.inc';

$rs = MongoShellServer::getReplicaSetInfo();
$dsn = MongoShellServer::getASecondaryNode();
$m = new MongoClient($dsn);
$m->setReadPreference(MongoClient::RP_SECONDARY);
$c = $m->selectCollection(dbname(), collname(__FILE__));

MongoLog::setModule( MongoLog::ALL );
MongoLog::setLevel( MongoLog::ALL );
MongoLog::setCallback( function($a, $b, $c) {
	static $foundPick = 0;
	
	if (preg_match('/finding.*STANDALONE/', $c)) {
		$foundPick = 1;
	}
	if ($foundPick == 1 && preg_match('/^pick server/', $c)) {
		$foundPick = 2;
	}
	if ($foundPick == 2 && preg_match('/type:/', $c)) {
		echo $c, "\n";
	}
} );

$l = $c->getIndexInfo();
?>
DONE
--EXPECTF--
- connection: type: SECONDARY, socket: %d, ping: 0, hash: %s:%d;-;.;%d
- connection: type: SECONDARY, socket: %d, ping: 0, hash: %s:%d;-;.;%d
DONE
