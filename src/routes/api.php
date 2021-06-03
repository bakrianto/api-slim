<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

// Import Monolog classes into the global namespace
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$container = $app->getContainer();

$container["logger"] = function ($c) {
	// create a log channel
	$log = new Logger("api");
	$log->pushHandler(new StreamHandler(__DIR__ . "/logs/app.log", Logger::INFO));

	return $log;
};


/**
 * This method restricts access to addresses. <br/>
 * To access is required a valid token.
 */
$app->add(new \Slim\Middleware\JwtAuthentication([
	// The secret key
	"secret" => SECRET,
	"rules" => [
		new \Slim\Middleware\JwtAuthentication\RequestPathRule([
			// Degenerate access to "/ws"
			"path" => "/ws",
			// It allows access to "news" without a token
			"passthrough" => [
				"/ws/employee",
				"/ws/employee/add",
				"/ws/employee/update",
				"/ws/employee/delete"
			]
		])
	]
]));

/**
 * This method settings CORS requests
 */
$app->add(function (Request $request, Response $response, $next) {
	$response = $next($request, $response);
	// Access-Control-Allow-Origin: <domain>, ... | *
	$response = $response->withHeader('Access-Control-Allow-Origin', '*')
		->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
		->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
	return $response;
});

/**
 * This method creates an urls group. 
 * establishes the base url "/public/ws/".
 */
$app->group("/ws", function () use ($app) {
	
	/**
	 * This method is used for add emp
	 **/
	$app->post("/employee/add", function (Request $request, Response $response) {	
		$emp = new Employee();		
		try {
			$data = $emp->empAdd($request);
			$response = $response->withHeader("Content-Type", "application/json");
			$response = $response->withStatus(200, "OK");
			$response = $response->getBody()->write(json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK | JSON_PRETTY_PRINT));			
			return $response;
		} catch (PDOException $e) {
			$this["logger"]->error("DataBase Error: {$e->getMessage()}");
		} catch (Exception $e) {
			$this["logger"]->error("General Error: {$e->getMessage()}");
		}
		finally {
			// Destroy the database connection
			$conn = null;
		}
	});

	/**
	 * This method is used for update emp
	 **/
	$app->post("/employee/update", function (Request $request, Response $response) {
		$emp = new Employee();		
		try {
			$data = $emp->empUpdate($request);
			$response = $response->withHeader("Content-Type", "application/json");
			$response = $response->withStatus(200, "OK");
			$response = $response->getBody()->write(json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK | JSON_PRETTY_PRINT));			
				return $response;
		} catch (PDOException $e) {
			$this["logger"]->error("DataBase Error: {$e->getMessage()}");
		} catch (Exception $e) {
			$this["logger"]->error("General Error: {$e->getMessage()}");
		}
		finally {
			// Destroy the database connection
			$conn = null;
		}
	});

	/**
	 * This method is used for list emp
	 **/
	$app->get("/employee", function (Request $request, Response $response) {
		$emp = new Employee();			
		try {
			$data = $emp->empList($request);
			$response = $response->withHeader("Content-Type", "application/json");
			$response = $response->withStatus(200, "OK");
			$response = $response->getBody()->write(json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK | JSON_PRETTY_PRINT));			
			return $response;
		} catch (PDOException $e) {
			$this["logger"]->error("DataBase Error: {$e->getMessage()}");
		} catch (Exception $e) {
			$this["logger"]->error("General Error: {$e->getMessage()}");
		}
		finally {
			// Destroy the database connection
			$conn = null;
		}
	});

	/**
	 * This method sets an emp into the database.
	 *
	 **/

	$app->get("/employee/{emp_id}", function (Request $request, Response $response) {	
		$emp = new Employee();		
		try {
			$data = $emp->empDetails($request);
			$response = $response->withHeader("Content-Type", "application/json");
			$response = $response->withStatus(200, "OK");
			$response = $response->getBody()->write(json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK | JSON_PRETTY_PRINT));			
			return $response;
		} catch (PDOException $e) {
			$this["logger"]->error("DataBase Error: {$e->getMessage()}");
		} catch (Exception $e) {
			$this["logger"]->error("General Error: {$e->getMessage()}");
		}
		finally {
			// Destroy the database connection
			$conn = null;
		}
	});

	/**
	 * This method is used for delete emp
	 **/
	$app->get("/employee/delete/{emp_id}", function (Request $request, Response $response) {
		$emp = new Employee();			
		try {
			$data = $emp->empDelete($request);
			$response = $response->withHeader("Content-Type", "application/json");
			$response = $response->withStatus(200, "OK");
			$response = $response->getBody()->write(json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK | JSON_PRETTY_PRINT));			
			return $response;
		} catch (PDOException $e) {
			$this["logger"]->error("DataBase Error: {$e->getMessage()}");
		} catch (Exception $e) {
			$this["logger"]->error("General Error: {$e->getMessage()}");
		}
		finally {
			// Destroy the database connection
			$conn = null;
		}
	});
});
?>
