<!DOCTYPE html>
<html>
<head></head>
<body>
    <?php 
        $conn = mysqli_connect('localhost', 'CS6314', 'password', 'CS6314');
    
        if($conn) {
            $sql = "SELECT name, ranking FROM BabyNames
                    WHERE year='$year' AND gender='$gender'";
//            echo 'success';
        } else {
            echo "Failed to connect to MySQL Database" . PHP_EOL;
            echo "<br>" . mysqli_connect_errno() . PHP_EOL;
            echo "<br>" . mysqli_connect_error() . PHP_EOL;
        }
    
    
        $year = '2005';
        $gender = 'm';
        $sql = "SELECT name, ranking FROM BabyNames WHERE year=2005 AND gender='m' ORDER BY ranking ASC";
        $result = $conn->query($sql);
        $res = "";
        if($result->num_rows > 0) {
            $res .= "<div class='container mt-5'>";
            $res .= "<table class='table'><tr><th>Ranking</th><th>Name</th><th>Year</th></tr>";
            while($row = $result->fetch_assoc()) {
                $res .= "<tr><td>" . $row["ranking"] . "</td><td>" . $row["name"] . "</td><td>" . $year . "</td></tr>";
            }
            $res .= "</div>";
        }
//        echo $res;
    
    
        $arr = array('1', '2', '3', '4', '5',);
    
        array_push($arr['1'], x);
        echo json_encode($arr);
        
        echo $arr['1'];
    ?>
</body>
</html>