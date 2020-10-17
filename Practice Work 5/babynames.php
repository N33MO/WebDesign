<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    
    <meta name="keywords" content="CS6314, PW5, PHP, SQL"/>
    <meta name="author" content="dxc190002"/>
    
    <!-- CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <style>
        h4, th, td {
            vertical-align: middle !important;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="container mt-3">
    <h1>Top-Five Baby Names</h1>
    <p>Apply php &amp; MySQL</p>
    
    <form action="" method="POST">
        <div class="form-group">
        <label for="year">Please select a year: </label>
        <select name="year" id="year">
            <option value="0000">All years</option>
            <option value="2005">2005</option>
            <option value="2006">2006</option>
            <option value="2007">2007</option>
            <option value="2008">2008</option>
            <option value="2009">2009</option>
            <option value="2010">2010</option>
            <option value="2011">2011</option>
            <option value="2012">2012</option>
            <option value="2013">2013</option>
            <option value="2014">2014</option>
            <option value="2015">2015</option>
        </select>
        </div>
        <div class="form-group">
        <label for="gender">Please select gender: </label>
        <select name="gender" id="gender">
            <option value="x">Both</option>
            <option value="m">Male</option>
            <option value="f">Female</option>
        </select>
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
    </form>
</div>
</body>
<?php
    if(isset($_POST['submit'])) {
        $year = $_POST['year'];
        $gender = $_POST['gender'];
        $conn = new mysqli('localhost', 'root', 'root', 'SSA');
        
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
                $res .= "<h4>Top 5 " . $g . " Names for Births in " . $year . "</h4>";
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
            $web .= "<h4>Top 5 Names for Births in " . $year . "</h4>";
            $web .= "<table class='table'>";
            $web .= "<tr><th>Ranking</th><th>Male name</th><th>Female name</th></tr>";
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
            $web .= "<h4>Top 5 " . $g . " Names for Births in 2005-2015</h4>";
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
            $web .= "<h4>Top Five names for Births in 2005-2015</h4>";
            $web .= "<table class='table'>";
            $web .= "<tr><th colspan='1' rowspan='2'>Year</th><th colspan='5'>Male name</th><th colspan='5'>Female name</th></tr>";
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
    }
?>
</html>