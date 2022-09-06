<?php
 
$username = 'chatchai.j@nrru.ac.th';
$password = 'Bangy123#';
$url = "https://login.microsoftonline.com/";


try {
    $authCtx = new AuthenticationContext($Url);
    $authCtx->acquireTokenForUser($username,$password);
    $ctx = new ClientContext($Url,$authCtx);
    printTasks($ctx);
}
catch (Exception $e) {
    echo 'Authentication failed: ',  $e->getMessage(), "\n";
}

function printTasks(ClientContext $ctx){
	
	$listTitle = 'Tasks';
	$web = $ctx->getWeb();
        $list = $web->getLists()->getByTitle($listTitle);
	$items = $list->getItems();
        $ctx->load($items);
        $ctx->executeQuery();
	foreach( $items->getData() as $item ) {
	    print "Task: '{$item->Title}'\r\n";
	}
}

?>