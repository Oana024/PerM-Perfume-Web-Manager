<?php

class Product
{
    private $productTable = "products";
    private $connection;
    public $id;
    public $name;
    public $price;
    public $description;

    public function __construct($db)
    {
        $this->connection = $db;
    }

    function create()
    {
        $stmt = $this->connection->prepare("
		INSERT INTO " . $this->productTable . "(`name`, `description`, `price`)
		VALUES(?,?,?)");

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->price = htmlspecialchars(strip_tags($this->price));

        $stmt->bind_param("ssi", $this->name, $this->description, $this->price);

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
		SET name= ?, description = ?, price = ?
		WHERE id = ?");

        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->price = htmlspecialchars(strip_tags($this->price));

        $stmt->bind_param("ssii", $this->name, $this->description, $this->price, $this->id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    function delete()
    {

        $stmt = $this->connection->prepare("
		DELETE FROM " . $this->productTable . " 
		WHERE id = ?");

        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bind_param("i", $this->id);

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
}

?>
