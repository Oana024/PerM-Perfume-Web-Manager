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
    private $season;
    private $occasion;
    private $taste;
    private $url_image;
    private $ingredients;

    public function __construct($db)
    {
        $this->connection = $db;
    }

    /**
     * @OA\Post(path="/PerM-Perfume-Web-Manager/API/product/create.php", tags={"Product"},
     * @OA\Response(response="201", description="Item was created"),
     * @OA\Response(response="503", description="Unable to create item"),
     * @OA\Response(response="400", description="Unable to create item. Data is incomplete")
     * )
     */
    function create()
    {
        $stmt = $this->connection->prepare("
		INSERT INTO " . $this->productTable . "(`name`, `brand`, `gender`, `price`, `description`, `stock`, `season`, `occasion`, `taste`, `url_image`, `ingredients`)
		VALUES(?,?,?,?,?,?,?,?,?,?,?)");

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->brand = htmlspecialchars(strip_tags($this->brand));
        $this->gender = htmlspecialchars(strip_tags($this->gender));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->stock = htmlspecialchars(strip_tags($this->stock));
        $this->season = htmlspecialchars(strip_tags($this->season));
        $this->occasion = htmlspecialchars(strip_tags($this->occasion));
        $this->taste = htmlspecialchars(strip_tags($this->taste));
        $this->url_image = htmlspecialchars(strip_tags($this->url_image));
        $this->ingredients = htmlspecialchars(strip_tags($this->ingredients));

        $stmt->bind_param("sssisi", $this->name, $this->brand, $this->gender,
            $this->price, $this->description, $this->stock, $this->season,
            $this->occasion, $this->taste, $this->url_image, $this->ingredients);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    /**
     * @OA\Get(
     *     path="/PerM-Perfume-Web-Manager/API/product/read.php?id={product_id}",
     *     tags={"Product"},
     *     @OA\Parameter(
     *          name="product_id",
     *          in="path",
     *          required=false,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(response="200", description="Success"),
     *      @OA\Response(response="404", description="No item found"),
     * )
     */
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
    /**
     * @OA\Put(path="/PerM-Perfume-Web-Manager/API/product/update", tags={"Product"},
     * @OA\Response(response="200", description="Item was updated"),
     * @OA\Response(response="503", description="Unable to update items"),
     * @OA\Response(response="400", description="Unable to update items. Data is incomplete")
     * )
     */
    function update()
    {

        $stmt = $this->connection->prepare("
		UPDATE " . $this->productTable . " 
		SET name= ?, brand = ?, gender = ?, price = ?, description = ?, stock = ?, season = ?, occasion = ?, taste = ?, url_image = ?, ingredients = ?
		WHERE id = ?");

        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->brand = htmlspecialchars(strip_tags($this->brand));
        $this->gender = htmlspecialchars(strip_tags($this->gender));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->stock = htmlspecialchars(strip_tags($this->stock));
        $this->season = htmlspecialchars(strip_tags($this->season));
        $this->occasion = htmlspecialchars(strip_tags($this->occasion));
        $this->taste = htmlspecialchars(strip_tags($this->taste));
        $this->url_image = htmlspecialchars(strip_tags($this->url_image));
        $this->ingredients = htmlspecialchars(strip_tags($this->ingredients));

        $stmt->bind_param("sssisii", $this->name, $this->brand, $this->gender, $this->price,
            $this->description, $this->stock, $this->season, $this->occasion, $this->taste,
            $this->url_image, $this->ingredients, $this->id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    /**
     * @OA\Delete(path="/PerM-Perfume-Web-Manager/API/product/delete/{product_id}", tags={"Product"},
     * @OA\Parameter(
     *      name="product_id",
     *      in="path",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
     *      )
     *     ),
     * @OA\Response(response="200", description="Item was deleted"),
     * @OA\Response(response="503", description="Unable to delete item")
     * )
     */
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

    /**
     * @return mixed
     */
    public function getUrlImage()
    {
        return $this->url_image;
    }

    /**
     * @param mixed $url_image
     */
    public function setUrlImage($url_image)
    {
        $this->url_image = $url_image;
    }

    /**
     * @return mixed
     */
    public function getIngredients()
    {
        return $this->ingredients;
    }

    /**
     * @param mixed $ingredients
     */
    public function setIngredients($ingredients)
    {
        $this->ingredients = $ingredients;
    }

}

?>
