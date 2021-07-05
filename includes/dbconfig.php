<?php

require __DIR__ . '/vendor/autoload.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

$serviceAccount = ServiceAccount::fromValue(__DIR__. '/google-service-account.json');
$database = (new Factory)->withServiceAccount($serviceAccount)->withDatabaseUri('https://ngemeal-b7948-default-rtdb.firebaseio.com/')->createDatabase();

