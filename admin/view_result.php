<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>View Results</title>
</head>
<body style="background-image:url(images/hah.jpg); background-repeat:no-repeat;">
    <?php
    include("../include/header.php");
    include("../include/connect.php");

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = "SELECT * FROM students WHERE id='$id'";
        $res = mysqli_query($conn, $query);
        $row = mysqli_fetch_array($res);
    }
    ?>

    <div class="all_student fix">
        <?php

        // Custom function to check grade point
        function grade_point($gd)
        {
            if ($gd < 40) return 0.0;
            elseif ($gd >= 40 && $gd < 45) return 2.0;
            elseif ($gd >= 45 && $gd < 50) return 2.25;
            elseif ($gd >= 50 && $gd < 55) return 2.50;
            elseif ($gd >= 55 && $gd < 60) return 2.75;
            elseif ($gd >= 60 && $gd < 65) return 3.00;
            elseif ($gd >= 65 && $gd < 70) return 3.25;
            elseif ($gd >= 70 && $gd < 75) return 3.50;
            elseif ($gd >= 75 && $gd < 80) return 3.75;
            elseif ($gd >= 80 && $gd <= 100) return 4.00;
        }
        ?>

        <div>
            <p style="text-align:center;color:#fff;background:purple;margin:0;padding:8px;">
                <?php echo "Name: " . $row['name'] . " <br>Student ID: " . $row['stud_id']; ?>
            </p>
        </div>

        <div>
            <p style="float:left;margin:0 0 5px 0;width:100%;text-align:center;">
                <a href="view_cgpa.php?vr=<?php echo $row['id']; ?>&vn=<?php echo $row['username']; ?>">
                    <button class="btn btn-info">View cgpa & completed course</button>
                </a>
            </p>
        </div>

        <form action="" method="post" style="width:23%;margin:0 auto;padding-bottom:5px;">
            <select name="seme" id="">
                <option value="1st">1st semester</option>
                <option value="2nd">2nd semester</option>
                <option value="3rd">3rd semester</option>
                <!-- Add other semester options as needed -->
            </select>
            <input type="submit" value="view Result" />
        </form>

        <?php
        // Select semester
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $row['stud_id'];
            $semester = $_POST['seme'];

            $i = 0;
            $ch = 0.0;
            $gp = 0;

            $result = mysqli_query($conn, "SELECT * FROM result WHERE st_id='$id' AND semester='$semester' ");

            if ($result) {
                ?>
                <p><?php echo "<p style='text-align:center;background:#ddd;color:#01C3AA;padding:5px;width:84%;margin:0 auto'>" . $semester . " Semester Result" ?></p>
                <table class="table table-bordered" style="text-align:center;width:85%;margin:0 auto">
                    <th>sub</th>
                    <th>Marks</th>
                    <th>Grade</th>
                    <th>Credit hr.</th>
                    <th>Status</th>
                    <?php
                    while ($rows = mysqli_fetch_array($result)) {
                        $i++;

                        // Retrieve credit hour directly from the database
                        $sub = $rows['sub'];
                        $creditHourQuery = "SELECT credit_hour FROM result WHERE st_id='$id' AND sub='$sub' AND semester='$semester'";
                        $creditHourResult = mysqli_query($conn, $creditHourQuery);
                        $creditHourRow = mysqli_fetch_array($creditHourResult);
                        $creditHour = floatval($creditHourRow['credit_hour']);

                        // Count total credit hour
                        $ch = $ch + $creditHour;
                        ?>
                        <tr>
                            <td><?php echo $rows['sub']; ?></td>
                            <td><?php echo $rows['marks']; ?></td>
                            <td>
                                <?php
                                // Set grade for individual sub
                                $mark = $rows['marks'];
                                if ($mark < 40) {
                                    echo "F";
                                } elseif ($mark >= 40 && $mark < 45) {
                                    echo "D";
                                } elseif ($mark >= 45 && $mark < 50) {
                                    echo "C";
                                }
                                elseif ($mark >= 50 && $mark < 55) {
                                    echo "C+";
                                }
                                elseif ($mark >= 55 && $mark < 60) {
                                    echo "B-";
                                }
                                elseif ($mark >= 60 && $mark < 65) {
                                    echo "B";
                                }
                                elseif ($mark >= 65 && $mark < 70) {
                                    echo "B+";
                                }
                                elseif ($mark >= 70 && $mark < 75) {
                                    echo "A-";
                                } elseif ($mark >= 75 && $mark < 80) {
                                    echo "A";
                                } elseif ($mark >= 80 && $mark <= 100) {
                                    echo "A+";
                                }

                                // Total grade point
                                $gp = $gp + ($creditHour * grade_point($rows['marks']));
                                ?>
                            </td>
                            <td><?php echo $creditHour; ?></td>
                            <td>
                                <?php
                                $stat = $rows['marks'];
                                if ($stat < 40) {
                                    echo "<span style='background:red;padding:3px 11px;color:#fff;'>Fail</span>";
                                } elseif ($stat >= 55 && $stat < 60) {
                                    echo "<span style='background:yellow'>Retake</span>";
                                } else {
                                    echo "<span style='background:green;padding:3px 6px;color:#fff;'>Pass</span>";
                                }
                                ?>
                            </td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td colspan="2">CGPA : </td>
                        <td colspan="2">
                            <?php
                            $sg = $gp / $ch;
                            echo "<span style='color:green;padding:3px 6px;font-size:20px'>" . round($sg, 2) . "</span>";
                            ?>
                        </td>
                        <td>
                            <?php
                    if ($sg ==4.0) {
                        echo "<span style='background:purple;padding:3px 6px;color:#fff;'>Outstanding";
                    }  
                    else if ($sg ==3.75) {
                        echo "<span style='background:purple;padding:3px 6px;color:#fff;'>Excellent";
                    }
                    else if ($sg ==3.50) {
                        echo "<span style='background:purple;padding:3px 6px;color:#fff;'>Very Good";
                    } elseif ($sg ==3.25) {
                        echo "<span style='background:green;padding:3px 6px;color:#fff;'>Good";
                    } elseif ($sg ==3.0) {
                        echo "<span style='background:gray;padding:3px 6px;color:#fff;'>Satisfactory";
                    }
                    elseif ($sg ==2.75) {
                        echo "<span style='background:green;padding:3px 6px;color:#fff;'>Below Satisfactory";
                    } elseif ($sg ==2.50) {
                        echo "<span style='background:gray;padding:3px 6px;color:#fff;'>Average";
                    } 
                    elseif ($sg ==2.25) {
                        echo "<span style='background:green;padding:3px 6px;color:#fff;'>Below Average";
                    } elseif ($sg ==2.00) {
                        echo "<span style='background:gray;padding:3px 6px;color:#fff;'>Poor";
                    }
                    else {
                        echo "<span style='background:red;padding:3px 6px;color:#fff;'>Probation";
                    }
                    ?>
                </td>
            </tr>
        </table>

    <?php
        } else {
            echo  "<p style='color:red;text-align:center'>Nothing Found</p>";
        }
    ?>
        <p style="float:left; text-align:right;margin:20px 0;width:49%"><a href="st_result_update.php?id=<?php echo $row['id'] ?>&seme=<?php echo $semester ?>&name=<?php echo $row['username']; ?>"><button class="btn btn-success">Edit Result</button></a></p>
    <?php
    }
    ?>

    
			<p style="float:right;text-align:left;margin:20px 0;width:49%"><a href="student.php"><button class="btn btn-success">Back to list</button></a></p>

</div>
<?php 
        include("../footer.php");
        ?>
<?php ob_end_flush() ; ?>