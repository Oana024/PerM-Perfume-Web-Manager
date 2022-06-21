<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Raport HTML</title>
    <style>
        table, th, td {
            border:1px solid black;
        }
    </style>
</head>
<body>
<section>
    <h2>
        Stocuri existente
    </h2>
    <table style="width:50%">
        <tr>
            <th>Brand</th>
            <th>Produse</th>
        </tr>
    <?php
    include_once '../API/config/Database.php';

    $database = new Database();
    $db = $database->getConnection();

    $stmt = $db->prepare("SELECT * FROM products ORDER BY stock DESC");
    $stmt -> execute();
    $result = $stmt->get_result();

    while($row = mysqli_fetch_assoc($result)) {
        echo '
                
                    <tr>
                        <td>'.$row['name'].'</td>
                        <td>'.$row['stock'].'</td>
                ';
    }
    ?>
    </table>
</section>
<section>
    <h2>
        Situatii vanzari
    </h2>
    <div>
        <h3>
            Categoria de parfumuri
        </h3>
        <div>
            <h4>
                In functie de brand
            </h4>
            <table style="width:50%">
                <tr>
                    <th>Brand</th>
                    <th>Produse Vandute</th>
                </tr>
            <?php
            $stmt = $db->prepare("SELECT DISTINCT brand FROM orders");
            $stmt -> execute();
            $result = $stmt->get_result();

            while($row = mysqli_fetch_assoc($result)) {
                $stmt1 = $db->prepare("SELECT COUNT(*) AS total FROM orders WHERE brand = ?");
                $stmt1 -> bind_param("s", $row["brand"]);
                $stmt1 -> execute();
                $result1 = $stmt1->get_result();
                $row1 = mysqli_fetch_assoc($result1);
                echo '
                <tr>
                        <td>'.$row['brand'].'</td>
                        <td>'.$row1['total'].'</td>';
            }

            ?>
            </table>

            <h4>
                In functie de ocazie
            </h4>
            <table style="width:50%">
                <tr>
                    <th>Ocazie</th>
                    <th>Produse Vandute</th>
                </tr>
            <?php
            $stmt = $db->prepare("SELECT DISTINCT occasion FROM orders");
            $stmt -> execute();
            $result = $stmt->get_result();

            while($row = mysqli_fetch_assoc($result)) {
                $stmt1 = $db->prepare("SELECT COUNT(*) AS total FROM orders WHERE occasion = ?");
                $stmt1 -> bind_param("s", $row["occasion"]);
                $stmt1 -> execute();
                $result1 = $stmt1->get_result();
                $row1 = mysqli_fetch_assoc($result1);
                echo '<tr>
                        <td>'.$row['occasion'].'</td>
                        <td>'.$row1['total'].'</td>';
            }

            ?>
            </table>

            <h4>
                In functie de aroma parfumurilor
            </h4>
            <table style="width:50%">
                <tr>
                    <th>Aroma</th>
                    <th>Produse Vandute</th>
                </tr>
            <?php
            $stmt = $db->prepare("SELECT DISTINCT taste FROM orders");
            $stmt -> execute();
            $result = $stmt->get_result();

            while($row = mysqli_fetch_assoc($result)) {
                $stmt1 = $db->prepare("SELECT COUNT(*) AS total FROM orders WHERE taste = ?");
                $stmt1 -> bind_param("s", $row["taste"]);
                $stmt1 -> execute();
                $result1 = $stmt1->get_result();
                $row1 = mysqli_fetch_assoc($result1);
                echo '<tr>
                        <td>'.$row['taste'].'</td>
                        <td>'.$row1['total'].'</td>';
            }

            ?>
            </table>
        </div>

    </div>
</section>
<section>
    <h3>
        Vanzari in functie de anotimp
    </h3>
    <table style="width:50%">
        <tr>
            <th>Anotimp</th>
            <th>Produse Vandute</th>
        </tr>
    <?php
    $stmt = $db->prepare("SELECT DISTINCT season FROM orders");
    $stmt -> execute();
    $result = $stmt->get_result();

    while($row = mysqli_fetch_assoc($result)) {
        $stmt1 = $db->prepare("SELECT COUNT(*) AS total FROM orders WHERE season = ?");
        $stmt1 -> bind_param("s", $row["season"]);
        $stmt1 -> execute();
        $result1 = $stmt1->get_result();
        $row1 = mysqli_fetch_assoc($result1);
        echo '<tr>
                        <td>'.$row['season'].'</td>
                        <td>'.$row1['total'].'</td>';
    }

    ?>
    </table>
</section>
</body>
</html>