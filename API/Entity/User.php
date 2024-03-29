<?php
class User{
    private $userTable = "users";
    private $connection;
    private $id;
    private $first_name;
    private $last_name;
    private $birthdate;
    private $username;
    private $email;
    private $password;
    private $gender;
    private $favourite_taste;


    public function __construct($db)
    {
        $this->connection = $db;
    }

    /**
     * @OA\Post(path="/PerM-Perfume-Web-Manager/API/user/create.php", tags={"User"},
     * @OA\Response(response="200", description="Successfully registered"),
     * @OA\Response(response="400", description="Wrong data format"),
     * @OA\Response(response="409", description="Data already exists")
     * )
     */
    function create()
    {
        $stmt = $this->connection->prepare("
		INSERT INTO " . $this->userTable . "
		(`first_name`, `last_name`, `birthdate`, `username`, `email`, `password`, `gender`, `favourite_taste`)
		VALUES(?,?,?,?,?,?,?,?)");

        if($this->favourite_taste == null){
            $this->favourite_taste = "";
        }

        $hashpassword = password_hash($this->password, PASSWORD_DEFAULT);

        $this->first_name = ucfirst($this->first_name);
        $this->last_name = ucfirst($this->last_name);

        $stmt->bind_param("ssssssss", $this->first_name, $this->last_name, $this->birthdate,
            $this->username, $this->email, $hashpassword, $this->gender, $this->favourite_taste);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    function verifyEmail() {
        $stmt = $this->connection->prepare("SELECT * FROM " . $this->userTable . " WHERE email = ?");
        $stmt -> bind_param("s", $this->email);
        $stmt -> execute();
        $result = $stmt->get_result();

        if(mysqli_num_rows($result) > 0){
            return -1;
        }

        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL))
            return 0;

        return 1;
    }

    function verifyUsername() {
        $stmt = $this->connection->prepare("SELECT * FROM " . $this->userTable . " WHERE username = ?");
        $stmt -> bind_param("s", $this->username);
        $stmt -> execute();
        $result = $stmt->get_result();

        if(mysqli_num_rows($result) > 0){
            return false;
        }

        return true;
    }

    function verifyDate() {
        return (date('d-m-Y', strtotime($this->birthdate)) == $this->birthdate);
    }

    function validUser() {
        $stmt = $this->connection->prepare("SELECT * FROM " . $this->userTable . " WHERE username = ?");
        $stmt -> bind_param("s", $this->username);
        $stmt -> execute();
        $result = $stmt->get_result();

        if(mysqli_num_rows($result) < 1){
            return -1;
        }

        $stmt = $this->connection->prepare("SELECT id, password FROM " . $this->userTable . " WHERE username = ?");
        $stmt -> bind_param("s", $this->username);
        $stmt -> execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        $check = password_verify($this->password, $row["password"]);

        if($check == false)
            return -2;

        return $row["id"];
    }

    /**
     * @OA\Get(path="/PerM-Perfume-Web-Manager/API/user/read.php?id={user_id}", tags={"User"},
     *     @OA\Parameter(
     *          name="user_id",
     *          in="path",
     *          required=true,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     * @OA\Response(response="200", description="Success"),
     * @OA\Response(response="404", description="Not found")
     * )
     */
    function read()
    {
        if ($this->id) {
            $stmt = $this->connection->prepare("SELECT * FROM " . $this->userTable . " WHERE id = ?");
            $stmt->bind_param("i", $this->id);
        } else {
            $stmt = $this->connection->prepare("SELECT * FROM " . $this->userTable);
        }
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    /**
     * @OA\Delete(path="/PerM-Perfume-Web-Manager/API/user/delete/{user_id}", tags={"User"},
     *     @OA\Parameter(
     *          name="user_id",
     *          in="path",
     *          required=true,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     * @OA\Response(response="200", description="Success"),
     * @OA\Response(response="404", description="Not found")
     * )
     */
    function delete()
    {
        $stmt = $this->connection->prepare("SELECT * FROM " . $this->userTable . " WHERE id = ?");
        $stmt -> bind_param("i", $this->id);
        $stmt -> execute();
        $result = $stmt->get_result();

        if(mysqli_num_rows($result) > 0){
            $stmt = $this->connection->prepare("DELETE FROM " . $this->userTable . " WHERE id = ?");

            $stmt->bind_param("i", $this->id);

            if ($stmt->execute()) {
                return true;
            }
        }
        return false;
    }

    /**
     * @OA\Put(path="/PerM-Perfume-Web-Manager/API/user/update.php", tags={"User"},
     * @OA\Response(response="200", description="Success"),
     * @OA\Response(response="404", description="Not found")
     * )
     */
    function update()
    {
        $stmt = $this->connection->prepare("
		UPDATE " . $this->userTable . " 
		SET first_name= ?, last_name = ?, birthdate = ?, username = ?, email = ?, password = ?, gender = ?, favourite_taste = ?
		WHERE id = ?");

        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->first_name = htmlspecialchars(strip_tags($this->first_name));
        $this->last_name = htmlspecialchars(strip_tags($this->last_name));
        $this->birthdate = htmlspecialchars(strip_tags($this->birthdate));
        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->gender = htmlspecialchars(strip_tags($this->gender));
        $this->favourite_taste = htmlspecialchars(strip_tags($this->favourite_taste));

        $stmt->bind_param("ssssssssi", $this->first_name, $this->last_name, $this->birthdate, $this->username,
            $this->email, $this->password, $this->gender, $this->favourite_taste, $this->id);

        echo $this -> username;

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * @param mixed $first_name
     */
    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * @param mixed $last_name
     */
    public function setLastName($last_name)
    {
        $this->last_name = $last_name;
    }

    /**
     * @return mixed
     */
    public function getBirthdate()
    {
        return $this->birthdate;
    }

    /**
     * @param mixed $birthdate
     */
    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param mixed $gender
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    /**
     * @return mixed
     */
    public function getFavouriteTaste()
    {
        return $this->favourite_taste;
    }

    /**
     * @param mixed $favourite_taste
     */
    public function setFavouriteTaste($favourite_taste)
    {
        $this->favourite_taste = $favourite_taste;
    }


}
