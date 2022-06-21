<?php

class Order {
    private $orderTable = "orders";
    private $connection;
    private $productId;
    private $userId;
    private $brand;
    private $season;
    private $occasion;
    private $taste;


    public function __construct($db)
    {
        $this->connection = $db;
    }

    /**
     * @OA\Post(path="/PerM-Perfume-Web-Manager/API/order/order", tags={"Order"},
     * @OA\Response(response="200", description="Successfully ordered"),
     * @OA\Response(response="400", description="Failed")
     * )
     */
    public function create() {
        $stmt = $this->connection->prepare("
		INSERT INTO " . $this->orderTable . "(`product_id`, `user_id`, `brand`, `season`, `occasion`, `taste`) VALUES(?,?,?,?,?,?)");
        $this->productId = htmlspecialchars(strip_tags($this->productId));
        $this->userId = htmlspecialchars(strip_tags($this->userId));
        $this->brand = htmlspecialchars(strip_tags($this->brand));
        $this->season = htmlspecialchars(strip_tags($this->season));
        $this->occasion = htmlspecialchars(strip_tags($this->occasion));
        $this->taste = htmlspecialchars(strip_tags($this->taste));
        $stmt->bind_param("iissss", $this->productId, $this->userId, $this->brand, $this->season, $this->occasion, $this->taste);

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

    /**
     * @return mixed
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @param mixed $brand
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;
    }

    /**
     * @return mixed
     */
    public function getSeason()
    {
        return $this->season;
    }

    /**
     * @param mixed $season
     */
    public function setSeason($season)
    {
        $this->season = $season;
    }

    /**
     * @return mixed
     */
    public function getOccasion()
    {
        return $this->occasion;
    }

    /**
     * @param mixed $occasion
     */
    public function setOccasion($occasion)
    {
        $this->occasion = $occasion;
    }

    /**
     * @return mixed
     */
    public function getTaste()
    {
        return $this->taste;
    }

    /**
     * @param mixed $taste
     */
    public function setTaste($taste)
    {
        $this->taste = $taste;
    }



}