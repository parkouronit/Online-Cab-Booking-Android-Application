<?php



class DB_Functions {

    private $conn;

    // constructor
    function __construct() {
        require_once 'DB_Connect.php';
        // connecting to database
        $db = new Db_Connect();
        $this->conn = $db->connect();
    }

    // destructor
    function __destruct() {

    }

    /**
     * Storing new user
     * returns user details
     */
    public function addCabs($n,$s){
      $stmt = $this->conn->prepare("INSERT INTO carselect(car_name,max_seats) VALUES(?, ?)");
      $stmt->bind_param("ss", $n, $s);
      $result = $stmt->execute();
      $stmt->close();
    }
    public function ver($id){
        $stmt = $this->conn->prepare("UPDATE driver set verified=1 WHERE driver_id = ?");
      $stmt->bind_param("s", $id);
      $result = $stmt->execute();
      $stmt->close();
    }
    public function storeUser($name, $email,$contact, $password) {
        $uuid = uniqid('', true);
        $hash = $this->hashSSHA($password);
        $encrypted_password = $hash["encrypted"]; // encrypted password
        $salt = $hash["salt"]; // salt
            
        $stmt = $this->conn->prepare("INSERT INTO users(unique_id, name, email,contact, encrypted_password, salt) VALUES(?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $uuid, $name, $email,$contact, $encrypted_password, $salt);
        $result = $stmt->execute();
        $stmt->close();
        
        // check for successful store
        if ($result) {
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();

            return $user;
        } else {
            return false;
        }
    }

    public function changePass($email,$oldpass,$newpass){
      $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
        echo 'checking email';
      $stmt->bind_param("s", $email);

      if ($stmt->execute()) {
          $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();
          echo 'fetching user ';
          // verifying user password
          $salt = $user['salt'];
          $encrypted_password = $user['encrypted_password'];
          $hash = $this->checkhashSSHA($salt, $oldpass);
          // check for password equality
          if ($encrypted_password == $hash) {
            echo 'compareing pass ';
            $hash = $this->hashSSHA($newpass);
            $encrypted_password = $hash["encrypted"]; // encrypted password
            $salt = $hash["salt"];
            $stmt = $this->conn->prepare("UPDATE users set encrypted_password=?,salt=? WHERE email = ?");
            echo 'updateing pass ';
            $stmt->bind_param("sss", $encrypted_password,$salt,$email);
              $stmt->execute();
              $stmt->close();

                return true;

            }else{
            return false;
          }
        }else{
          return false;
        }
    }

    /**
     * Get user by email and password
     */
    
    public function Update_User_Location_by_Email($Email,$Latitude,$Longitude){

				$stmt = $this->conn->prepare("UPDATE users SET latitude=?,longitude=? WHERE email = ?");
				$stmt->bindParam(1, $Latitude);
				$stmt->bindParam(2, $Longitude);
				$stmt->bindParam(3, $Email);
				$stmt->execute();

			if($stmt->rowCount()){

					return true; // return 2 because was not update any entity, because was nothing to modify

				}else{
					return false;  // return 1 because it is false
					}

	 } // end function Update_User;


    /**
     * Check user is existed or not
     */
    public function isUserExisted($email) {
        $stmt = $this->conn->prepare("SELECT email from users WHERE email = ?");

        $stmt->bind_param("s", $email);

        $stmt->execute();

        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // user existed
            $stmt->close();
            return true;
        } else {
            // user not existed
            $stmt->close();
            return false;
        }
    }

    /**
     * Encrypting password
     * @param password
     * returns salt and encrypted password
     */
    public function hashSSHA($password) {

        $salt = sha1(rand());
        $salt = substr($salt, 0, 10);
        $encrypted = base64_encode(sha1($password . $salt, true) . $salt);
        $hash = array("salt" => $salt, "encrypted" => $encrypted);
        return $hash;
    }

    /**
     * Decrypting password
     * @param salt, password
     * returns hash string
     */
    public function checkhashSSHA($salt, $password) {

        $hash = base64_encode(sha1($password . $salt, true) . $salt);

        return $hash;
    }
    public function storeAdmin($name, $email,$contact, $password) {
        $uuid = uniqid('', true);
        $hash = $this->hashSSHA($password);
        $encrypted_password = $hash["encrypted"]; // encrypted password
        $salt = $hash["salt"]; // salt

        $stmt = $this->conn->prepare("INSERT INTO admin(unique_id, a_name, a_email,a_contact, encrypted_password, salt) VALUES(?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $uuid, $name, $email,$contact, $encrypted_password, $salt);
        $result = $stmt->execute();
        $stmt->close();

        // check for successful store
        if ($result) {
            $stmt = $this->conn->prepare("SELECT * FROM admin WHERE a_email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();

            return $user;
        } else {
            return false;
        }
    }
    public function getAdmin($email, $password) {

        $stmt = $this->conn->prepare("SELECT * FROM admin WHERE a_email = ?");

        $stmt->bind_param("s", $email);

        if ($stmt->execute()) {
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();

            // verifying user password
            $salt = $user['salt'];
            $encrypted_password = $user['encrypted_password'];
            $hash = $this->checkhashSSHA($salt, $password);
            // check for password equality
            if ($encrypted_password == $hash) {
                // user authentication details are correct
				
				$_SESSION['a_name']=$user['a_name'];
				$_SESSION['login'] = 1;
                return $user;
            }
        } else {
            echo "<script typr='text/javascript'>alert('wrong password!!');</script>";
            return NULL;
        }
    }
    public function getUser($email, $password) {

        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?");

        $stmt->bind_param("s", $email);

        if ($stmt->execute()) {
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();

            // verifying user password
            $salt = $user['salt'];
            $encrypted_password = $user['encrypted_password'];
            $hash = $this->checkhashSSHA($salt, $password);
            // check for password equality
            if ($encrypted_password == $hash) {
                // user authentication details are correct
				
                return $user;
            }
        } else {
            echo "<script typr='text/javascript'>alert('wrong password!!');</script>";
            return NULL;
        }
    }
    
    public function isAdminExisted($email) {
        $stmt = $this->conn->prepare("SELECT a_email from admin WHERE a_email = ?");

        $stmt->bind_param("s", $email);

        $stmt->execute();

        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // user existed
            $stmt->close();
            return true;
        } else {
           
            // user not existed
            $stmt->close();
            return false;
        }
    }
    public function isUserLoggedIn()
    {
        if (isset($_SESSION['login']) AND $_SESSION['login'] == 1) {
            return true;
        }else{
            return false; 
        }
             
        
       
      
       
    }
    public function storeDriver($name, $email,$contact,$cartype, $password) {
        $uuid = uniqid('', true);
        $hash = $this->hashSSHA($password);
        $encrypted_password = $hash["encrypted"]; // encrypted password
        $salt = $hash["salt"]; // salt

        $stmt = $this->conn->prepare("INSERT INTO driver(unique_id, name, email,contact,car_name, encrypted_password, salt) VALUES(?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $uuid, $name, $email,$contact,$cartype, $encrypted_password, $salt);
        $result = $stmt->execute();
        $stmt->close();

        // check for successful store
        if ($result) {
            $stmt = $this->conn->prepare("SELECT * FROM driver WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();

            return $user;
        } else {
            return false;
        }
    }
    public function getU($email, $password) {

        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?");

        $stmt->bind_param("s", $email);

        if ($stmt->execute()) {
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();

            // verifying user password
            $salt = $user['salt'];
            $encrypted_password = $user['encrypted_password'];
            $hash = $this->checkhashSSHA($salt, $password);
            
            // check for password equality
            if ($encrypted_password == $hash) {
                // user authentication details are correct
			
                return $user;
            }
        } else {
            return NULL;
        }
    } 
	public function getDriver($email, $password) {

        $stmt = $this->conn->prepare("SELECT * FROM driver WHERE email = ?");

        $stmt->bind_param("s", $email);

        if ($stmt->execute()) {
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();

            // verifying user password
            $salt = $user['salt'];
            $encrypted_password = $user['encrypted_password'];
            $hash = $this->checkhashSSHA($salt, $password);
    
            // check for password equality
            if ($encrypted_password == $hash) {
                // user authentication details are correct
			
                return $user;
            }
        } else {
            return NULL;
        }
    }
    
	public function isDriverExisted($email) {
        $stmt = $this->conn->prepare("SELECT email from driver WHERE email = ?");

        $stmt->bind_param("s", $email);

        $stmt->execute();

        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // user existed
            $stmt->close();
            return true;
        } else {
            // user not existed
            $stmt->close();
            return false;
        }
    }
}

?>
