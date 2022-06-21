<?php
/**
 * @OA\Info(title="PerM API", version="1.0")
 */
class Comment
{
    private $commandTable = "comments";
    private $connection;
    private $id;
    private $productId;
    private $userId;
    private $review;

    public function __construct($db)
    {
        $this->connection = $db;
    }

    /**
     * @OA\Post(path="/PerM-Perfume-Web-Manager/API/comment/create", tags={"Comment"},
     * @OA\Response(response="200", description="Successfully added"),
     * @OA\Response(response="400", description="Something went wrong")
     * )
     */
    function create()
    {
        $stmt = $this->connection->prepare("
		INSERT INTO " . $this->commandTable . "(`product_id`, `user_id`, `review`)
		VALUES(?,?,?)");

        $this->productId = htmlspecialchars(strip_tags($this->productId));
        $this->userId = htmlspecialchars(strip_tags($this->userId));
        $this->review = htmlspecialchars(strip_tags($this->review));

        $stmt->bind_param("iis", $this->productId, $this->userId, $this->review);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    function read()
    {
        if ($this->id) {
            $stmt = $this->connection->prepare("SELECT * FROM " . $this->commandTable . " WHERE id = ?");
            $stmt->bind_param("i", $this->id);
        } else {
            $stmt = $this->connection->prepare("SELECT * FROM " . $this->commandTable);
        }
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    function update()
    {

        $stmt = $this->connection->prepare("
		UPDATE " . $this->commandTable . " 
		SET product_id= ?, user_id = ?, review = ?
		WHERE id = ?");

        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->productId = htmlspecialchars(strip_tags($this->productId));
        $this->userId = htmlspecialchars(strip_tags($this->userId));
        $this->review = htmlspecialchars(strip_tags($this->review));

        $stmt->bind_param("iisi", $this->productId, $this->userId, $this->review, $this->id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    function delete()
    {
        $stmt = $this->connection->prepare("SELECT * FROM " . $this->commandTable . " WHERE id = ?");
        $stmt -> bind_param("i", $this->id);
        $stmt -> execute();
        $result = $stmt->get_result();

        if(mysqli_num_rows($result) > 0){
            $stmt = $this->connection->prepare("DELETE FROM " . $this->commandTable . " WHERE id = ?");

            $stmt->bind_param("i", $this->id);

            if ($stmt->execute()) {
                return true;
            }
        }
        return false;
    }

    /**
     * @return string
     */
    public function getCommandTable()
    {
        return $this->commandTable;
    }

    /**
     * @param string $commandTable
     */
    public function setCommandTable($commandTable)
    {
        $this->commandTable = $commandTable;
    }

    /**
     * @return mixed
     */
    public function getConnection()
    {
        return $this->connection;
    }

    /**
     * @param mixed $connection
     */
    public function setConnection($connection)
    {
        $this->connection = $connection;
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
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * @param mixed $productId
     */
    public function setProductId($productId)
    {
        $this->productId = $productId;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return mixed
     */
    public function getReview()
    {
        return $this->review;
    }

    /**
     * @param mixed $review
     */
    public function setReview($review)
    {
        $this->review = $review;
    }


}