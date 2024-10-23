<?php
session_start();
$pageTitle = "Total Selected Students";
include("header.php"); // Include header file
include("sidebar.php"); // Include sidebar file
include("../include/connect.php");
?>

<main id="main" class="main">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="container mt-5">
                    <!-- Dropdowns for filtering by Year and Semester -->
                    <form method="POST" action="">
                        <div class="form-group">
                            <label for="year"><h3>Select Year:</h3></label>
                            <select name="year" id="year" class="form-control" onchange="this.form.submit()">
                                <option value="">All Years</option>
                                <?php
                                // Define academic years (1st, 2nd, 3rd, 4th Year)
                                $years = ["1st", "2nd", "3rd", "4th"];
                                foreach ($years as $year) {
                                    $selected = (isset($_POST['year']) && $_POST['year'] == $year) ? 'selected' : '';
                                    echo "<option value='$year' $selected>$year Year</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="semester"><h3>Select Semester:</h3></label>
                            <select name="semester" id="semester" class="form-control" onchange="this.form.submit()">
                                <option value="">All Semesters</option>
                                <option value="1" <?php echo (isset($_POST['semester']) && $_POST['semester'] == '1') ? 'selected' : ''; ?>>1st Semester</option>
                                <option value="2" <?php echo (isset($_POST['semester']) && $_POST['semester'] == '2') ? 'selected' : ''; ?>>2nd Semester</option>
                            </select>
                        </div>
                    </form>

                    <div class="card mt-4">
                        <div class="card-body">
                            <h5 class="card-title text-center" style="color:#fff; background:orange; margin:0; padding:8px;">Total Selected Students for Improvement</h5>
                            <div id="result" class="animate__animated"> <!-- Animation class will be added here -->
                            <?php
                            // Get selected year and semester from the form
                            $selected_year = isset($_POST['year']) ? $_POST['year'] : '';
                            $selected_semester = isset($_POST['semester']) ? $_POST['semester'] : '';

                            // Prepare the SQL query dynamically based on filters
                            $query = "SELECT course_details FROM imp_form WHERE status='Approved'";
                            
                            // Initialize conditions array for filtering
                            $conditions = [];

                            // Check if a specific year was selected
                            if (!empty($selected_year)) {
                                // Map the year string to numeric value in the JSON (e.g., 1st Year -> 1)
                                $year_map = [
                                    '1st' => '1',
                                    '2nd' => '2',
                                    '3rd' => '3',
                                    '4th' => '4'
                                ];
                                $year_value = $year_map[$selected_year];
                                $conditions[] = "JSON_UNQUOTE(JSON_EXTRACT(course_details, '$[0].year')) = '$year_value'";
                            }

                            // Check if a specific semester was selected
                            if (!empty($selected_semester)) {
                                $conditions[] = "JSON_UNQUOTE(JSON_EXTRACT(course_details, '$[0].semester')) = '$selected_semester'";
                            }

                            // Append conditions to the query if there are any
                            if (count($conditions) > 0) {
                                $query .= " AND " . implode(" AND ", $conditions);
                            }

                            $result = mysqli_query($conn, $query);

                            // Initialize an array to store courses
                            $courses = [];

                            if ($result && mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    // Parse course details JSON
                                    $course_details = json_decode($row['course_details'], true);
                                    if ($course_details && count($course_details) > 0) {
                                        foreach ($course_details as $course) {
                                            // If year and semester were not selected, include all data
                                            if ((empty($selected_year) || $course['year'] == $year_value) &&
                                                (empty($selected_semester) || $course['semester'] == $selected_semester)) {
                                                

                                                // Store course details
                                                $courses[] = [
                                                    'year' => htmlspecialchars($course['year']),
                                                    'semester' => htmlspecialchars($course['semester']),
                                                    'courseCode' => htmlspecialchars($course['courseCode']),
                                                    'courseTitle' => htmlspecialchars($course['courseTitle']),
                                                    'courseCredit' => htmlspecialchars($course['courseCredit']),
                                                    'gpaObtained' => htmlspecialchars($course['gpaObtained'])
                                                ];
                                            }
                                        }
                                    }
                                }

                                // Display courses
                                if (!empty($courses)) {
                                    echo "<table class='table table-bordered table-striped'>";
                                    echo "<thead><tr>
                                            <th class='bg-info'>Year</th>
                                            <th class='bg-info'>Semester</th>
                                            <th class='bg-info'>Course Code</th>
                                            <th class='bg-info'>Course Name</th>
                                            <th class='bg-info'>Credit Hour</th>
                                            <th class='bg-info'>Previous CGPA</th>
                                            <th class='bg-info'>Improved CGPA</th>
                                        </tr></thead>";
                                    echo "<tbody>";
                                    foreach ($courses as $course) {
                                        echo "<tr>
                                                <td>" . $course['year'] . " Year</td>
                                                <td>" . $course['semester'] . " Semester</td>
                                                <td>" . $course['courseCode'] . "</td>
                                                <td>" . $course['courseTitle'] . "</td>
                                                <td>" . $course['courseCredit'] . "</td>
                                                <td>" . $course['gpaObtained'] . "</td>
                                                <td>N/A</td>
                                              </tr>";
                                    }
                                    echo "</tbody></table>";
                                } else {
                                    echo "<p>No data available for the selected filters.</p>";
                                }
                            } else {
                                echo "<p>No data available for the selected filters.</p>";
                            }
                            ?>
                            </div> <!-- End of result div -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include("footer.php"); ?>

<script>
    // Function to add animation classes when the form is submitted
    document.querySelectorAll('select').forEach(function(select) {
        select.addEventListener('change', function() {
            // Add animation class
            const resultDiv = document.getElementById('result');
            resultDiv.classList.remove('animate__fadeIn');
            void resultDiv.offsetWidth; // Trigger reflow
            resultDiv.classList.add('animate__fadeIn');
        });
    });
</script>
