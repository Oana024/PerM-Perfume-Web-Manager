<?php

class Order {
    private $orderTable = "orders";
    private $connection;
    private $productId;
    private $userId;


    public function __construct($db)
    {
        $this->connection = $db;
    }

    public function create() {
        $stmt = $this->connection->prepare("
		INSERT INTO " . $this->orderTable . "(`product_id`, `user_id`) VALUES(?,?)");
        $this->productId = htmlspecialchars(strip_tags($this->productId));
        $this->userId = htmlspecialchars(strip_tags($this->userId));
        $stmt->bind_param("ii", $this->productId, $this->userId);

        if ($stmt->execute()) {
            return true;
        }
        return false;
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



}