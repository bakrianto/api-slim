<?php
/**
 * @package Employee WebAPI
 *
 * @author Techarise Team
 *
 * @email  info@techarise.com
 *   
 * @ Version 1.0.0 
 */
 
class Employee
{
	protected $_db;
	public function __construct() {
        $this->_db = DBConnection::getConnection();
    }

	// User registration Method
    public function empAdd($request) {
    	// @var string $guid - Unique ID
		$guid = uniqid();
		// @var string $name - Name
		$name = $request->getParam("name");
		// @var string $email - Email
		$email = trim(strtolower($request->getParam("email")));
		// @var string $salary - salary
		$salary = $request->getParam("salary");
		// @var string $age - age
		$age = $request->getParam("age");
		try{

			$sql = "SELECT	*
					FROM	employee
					WHERE	email = :email";
			$stmt = $this->_db->prepare($sql);
			$stmt->bindParam(":email", $email);
			$stmt->execute();
			$query = $stmt->fetchObject();

			if($query) {
				$data["status"] = "Error: Your account cannot be created at this time. Please try again later.";
			} else {
				// Gets the user into the database
				$sql = "INSERT INTO	employee (name, email, salary, age)
						VALUES		(:name, :email, :salary, :age)";

				$stmt = $this->_db->prepare($sql);

				$stmt->bindParam(":name", $name);
				$stmt->bindParam(":email", $email);
				$stmt->bindParam(":salary", $salary);
				$stmt->bindParam(":age", $age);

				$stmt->execute();
				$result = $this->_db->lastInsertId();
				if ($result) {
					$data["status"] = "Your account has been successfully created.";
				} else {
					$data["status"] = "Error: Your account cannot be create at this time. Please try again later.";
				}
			}
    
    	return $data; 
    } catch(PDOException $e) {
			echo "Error: ".$e->getMessage();
		}
	}

	// emp listing Method
    public function empUpdate($request) {
    	//@var string $guid - Unique ID
		$guid = uniqid();
		// @var string $age - age
		$emp_id = $request->getParam("emp_id");
		// @var string $name - Name
		$name = $request->getParam("name");
		// @var string $email - Email
		$email = trim(strtolower($request->getParam("email")));
		// @var string $salary - salary
		$salary = $request->getParam("salary");
		// @var string $age - age
		$age = $request->getParam("age");

		try{
			$sql = "UPDATE	employee
					SET name = :name, 
						email = :email, 
						salary = :salary, 
						age = :age 
					WHERE	id = :emp_id";
			$stmt = $this->_db->prepare($sql);
			
			$stmt->bindParam(":name", $name);
			$stmt->bindParam(":email", $email);
			$stmt->bindParam(":salary", $salary);
			$stmt->bindParam(":age", $age);
			$stmt->bindParam(":emp_id", $emp_id);
			$result = $stmt->execute();
			if ($result) {
				$data["status"] = "Your account has been successfully updated.";
			} else {
				$data["status"] = "Error: Your account cannot be updated at this time. Please try again later.";
			}
    	return $data; 
    	} catch(PDOException $e) {
			echo "Error: ".$e->getMessage();
		}
    
	}

    // emp listing Method
    public function empList($request) {
    	//@var string $guid - Unique ID
		$guid = uniqid();
		//@var string $token - Activation token
		$token = bin2hex(openssl_random_pseudo_bytes(16));
		try{
			$sql = "SELECT e.id, e.name, e.email, e.salary, e.age
					FROM employee as e
					ORDER BY e.id DESC";
			$stmt = $this->_db->prepare($sql);
			$stmt->bindParam(":post_status", $publish);
			$stmt->execute();
			$query = $stmt->fetchAll();
			$data = $query;
    	return $data; 
    	} catch(PDOException $e) {
			echo "Error: ".$e->getMessage();
		}
    
	}
 	// get emp details  Method
    public function empDetails($request) {
    	// @var string $guid - Unique ID
		$guid = uniqid();
		$emp_id = $request->getAttribute("emp_id");
		try{
			$sql = "SELECT e.id, e.name, e.email, e.salary, e.age
					FROM employee as e
					WHERE	e.id = :emp_id";
			$stmt = $this->_db->prepare($sql);
			$stmt->bindParam(":emp_id", $emp_id);
			$stmt->execute();
			$query = $stmt->fetch(\PDO::FETCH_ASSOC);
			$data = $query;
	    	return $data; 
	    } catch(PDOException $e){
			echo "Error: ".$e->getMessage();
		}
    
	}

	// delete emp method
	public function empDelete($request) {
		// @var string $guid - Unique ID
		$guid = uniqid();
		$emp_id = $request->getAttribute("emp_id");
		try{
			// Delete the quote
			$sql = "DELETE FROM	employee
					WHERE id = :emp_id";
			$stmt = $this->_db->prepare($sql);
			$stmt->bindParam(":emp_id", $emp_id);
			$result = $stmt->execute();
			if ($result) {
				$data["status"] = "Your account has been successfully deleted.";
			} else {
				$data["status"] = "Error: Your account cannot be delete at this time. Please try again later.";
			}
			return $data; 
		} catch(PDOException $e){
			echo "Error: ".$e->getMessage();
		}
	}
}
