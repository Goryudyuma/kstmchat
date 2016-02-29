<?php
// Routes

require __dir__.'/database.php';

$app->post('/register/{user_name}/{password}', function($request, $response, $args){
	global $pdo;
	if (!is_string($args['user_name']) || !is_string($args['password']) ) {
		return '{"status" : "error" , "contents" : "ユーザー名かパスワードがstringではありません"}';
	}
	$var['user_name'] = $args['user_name'];
	$var['password'] = password_hash($args['password'], PASSWORD_DEFAULT);

	$sth = $pdo->prepare('SELECT COUNT(1) AS c FROM user WHERE name = :name ;');
	$sth->bindParam(':name', $var['user_name'], PDO::PARAM_STR);

	$sth->execute();
	$result = $sth->fetch();

	if (((int)$result['c']) !== 0) {
		return '{"status" : "error" , "contents" : "同じ名前の人がいます"}';
	} else {
		$sth = $pdo->prepare('INSERT INTO user(`id`, `name`, `password`) VALUES(NULL, :name, :password);');
		$sth->bindParam(':name', $var['user_name'], PDO::PARAM_STR);
		$sth->bindParam(':password', $var['password'], PDO::PARAM_STR);

		$sth->execute();

		return '{"status" : "success" }';
	}
});



/*
$app->get('/test/{name}/{pass}', function ($request, $response, $args){
	$this->logger->info(print_r($args, 1));

	return var_dump($args);
});

$app->get('/[{name}]', function ($request, $response, $args) {
	// Sample log message
	$this->logger->info("Slim-Skeleton '/' route");

	// Render index view
	return $this->renderer->render($response, 'index.phtml', $args);
});
 */
