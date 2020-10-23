<?php
//session_start();
$year = $_POST["year"];
$gender = $_POST["gender"];

if(empty($year) || empty($gender)) {
    header('Location: babynames.html');
}

$conn = new mysqli('localhost', 'CS6314', 'password', 'CS6314');

if($conn -> connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

if($year != '0000' && $gender != 'x') {
    $sql = "SELECT name, ranking FROM BabyNames WHERE year='$year' AND gender='$gender' ORDER BY ranking ASC";
    $result = $conn->query($sql);
    $res = "";
    if($result->num_rows > 0) {
        $res .= "<div class='container mt-5'>";
        if($gender == 'm') $g = 'Male';
        else $g = 'Female';
        $res .= "<h4 class='heading'>Top 5 " . $g . " Names for Births in " . $year . "</h4>";
        $res .= "<table class='table'><tr><th>Ranking</th><th>Name</th><th>Year</th></tr>";
        while($row = $result->fetch_assoc()) {
            $res .= "<tr><td>" . $row["ranking"] . "</td><td>" . $row["name"] . "</td><td>" . $year . "</td></tr>";
        }
        $res .= "</table></div>";
    }
    echo $res;
}
else if($year != '0000') {
    $male = array();
    $sql = "SELECT name, ranking FROM BabyNames WHERE year='$year' AND gender='m' ORDER BY ranking ASC";
    $result = $conn->query($sql);
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc())
            array_push($male, $row["name"]);
    }
    $female = array();
    $sql = "SELECT name, ranking FROM BabyNames WHERE year='$year' AND gender='f' ORDER BY ranking ASC";
    $result = $conn->query($sql);
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc())
            array_push($female, $row["name"]);
    }

    $web = "<div class='container mt-5'>";
    $web .= "<h4 class='heading'>Top 5 Names for Births in " . $year . "</h4>";
    $web .= "<table class='table'>";
    $web .= "<tr><th>Ranking</th><th class='male'>Male name</th><th class='female'>Female name</th></tr>";
    $arr = array(0, 1, 2, 3, 4);
    foreach($arr as &$idx) {
        $web .= "<tr><td>" . $year . "</td><td>" . $male[$idx] . "</td><td>" . $female[$idx] . "</td></tr>";
    }
    $web .= "</table></div>";
    echo $web;
}
else if($gender != 'x') {
    $y = array(2005, 2006, 2007, 2008, 2009, 2010, 2011, 2012, 2013, 2014, 2015);
    if($gender == 'm') $g = 'Male';
    else $g = 'Female';
    $web = "<div class='container-fluid mt-5'>";
    $web .= "<h4 class='heading'>Top 5 " . $g . " Names for Births in 2005-2015</h4>";
    $web .= "<table class='table'>";
    $web .= "<tr><th>Year</th><th>Rank1</th><th>Rank 2</th><th>Rank 3</th><th>Rank 4</th><th>Rank 5</th></tr>";


    foreach($y as &$year) {
        $sql = "SELECT name, ranking FROM BabyNames WHERE year='$year' AND gender='$gender' ORDER BY ranking ASC";
        $result = $conn->query($sql);
        if($result->num_rows > 0) {
            $web .= "<tr><td>" . $year . "</td>";
            while($row = $result->fetch_assoc())
                $web .= "<td>". $row['name'] . "</td>";
            $web .= "</tr>";
        }
    }
    $web .= "</table></div>";

    echo $web;
}
else {
    $y = array(2005, 2006, 2007, 2008, 2009, 2010, 2011, 2012, 2013, 2014, 2015);
    $g = array('m', 'f');
    $web = "<div class='container-fluid mt-5'>";
    $web .= "<h4 class='heading'>Top Five names for Births in 2005-2015</h4>";
    $web .= "<table class='table'>";
    $web .= "<tr><th colspan='1' rowspan='2'>Year</th><th colspan='5' class='male'>Male name</th><th colspan='5' class='female'>Female name</th></tr>";
    $web .= "<tr><th>Rank1</th><th>Rank2</th><th>Rank3</th><th>Rank4</th><th>Rank5</th><th>Rank1</th><th>Rank2</th><th>Rank3</th><th>Rank4</th><th>Rank5</th></tr>";

    foreach($y as &$year) {
        $web .= "<tr><td>" . $year . "</td>";
        foreach($g as &$gender) {
            $sql = "SELECT name, ranking FROM BabyNames WHERE year='$year' AND gender='$gender' ORDER BY ranking ASC";
            $result = $conn->query($sql);
            if($result->num_rows > 0) {
                while($row = $result->fetch_assoc())
                    $web .= "<td>". $row['name'] . "</td>";
            }
        }
        $web .= "</tr>";
    }
    $web .= "</table></div>";

    echo $web;

}


$conn->close();
?>