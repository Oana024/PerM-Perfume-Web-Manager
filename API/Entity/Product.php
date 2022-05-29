<?php

class Product
{
    private $productTable = "products";
    private $connection;
    private $id;
    private $name;
    private $brand;
    private $gender;
    private $price;
    private $description;
    private $stock;

    public function __construct($db)
    {
        $this->connection = $db;
    }

    function create()
    {
        $stmt = $this->connection->prepare("
		INSERT INTO " . $this->productTable . "(`name`, `brand`, `gender`, `price`, `description`, `stock`)
		VALUES(?,?,?,?,?,?)");

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->brand = htmlspecialchars(strip_tags($this->brand));
        $this->gender = htmlspecialchars(strip_tags($this->gender));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->stock = htmlspecialchars(strip_tags($this->stock));

        $stmt->bind_param("sssisi", $this->name, $this->brand, $this->gender,
            $this->price, $this->description, $this->stock);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    function read()
    {
        if ($this->id) {
            $stmt = $this->connection->prepare("SELECT * FROM " . $this->productTable . " WHERE id = ?");
            $stmt->bind_param("i", $this->id);
        } else {
            $stmt = $this->connection->prepare("SELECT * FROM " . $this->productTable);
        }
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    function update()
    {

        $stmt = $this->connection->prepare("
		UPDATE " . $this->productTable . " 
		SET name= ?, brand = ?, gender = ?, price = ?, description = ?, stock = ?
		WHERE id = ?");

        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->brand = htmlspecialchars(strip_tags($this->brand));
        $this->gender = htmlspecialchars(strip_tags($this->gender));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->stock = htmlspecialchars(strip_tags($this->stock));

        $stmt->bind_param("sssisii", $this->name, $this->brand, $this->gender, $this->price,
            $this->description, $this->stock, $this->id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    function delete()
    {
        $stmt = $this->connection->prepare("SELECT * FROM " . $this->productTable . " WHERE id = ?");
        $stmt -> bind_param("i", $this->id);
        $stmt -> execute();
        $result = $stmt->get_result();

        if(mysqli_num_rows($result) > 0){
            $stmt = $this->connection->prepare("DELETE FROM " . $this->productTable . " WHERE id = ?");

            $stmt->bind_param("i", $this->id);

            if ($stmt->execute()) {
                return true;
            }
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
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
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * @param mixed $stock
     */
    public function setStock($stock)
    {
        $this->stock = $stock;
    }

}

?>
