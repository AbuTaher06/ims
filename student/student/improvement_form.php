<!DOCTYPE html>
<html>
    <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- Include jQuery (for AJAX submission) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </head>
    <style>
    </style>
<body style="font-family: 'Noto Sans Bengali UI', sans-serif;">
<?php
include("../include/connect.php");
?>
<div style="text-align: center;">
    <h3 style="margin-bottom: -10px;">পরীক্ষা নিয়ন্ত্রক দপ্তর</h3>
    <div style="display: inline-block;">
        <img src="./img/jkkniu.png" style="vertical-align: middle; height: 100px; width: auto;">
    </div>
    <div style="display: inline-block; vertical-align: middle;">
        <h2 style="padding: 0; margin-bottom: -10px;">জাতীয় কবি কাজী নজরুল ইসলাম বিশ্ববিদ্যালয়</h2>
        <h2 style="padding: 0;">ত্রিশাল, ময়মনসিংহ  ২২২৪</h2>
    </div>
</div>
<hr style="border-top: 2px solid;">
<h3 style="text-align: center;">ফলোন্নয়ন/এফ গ্রেড থেকে উন্নয়ন পরীক্ষার অনুমোদনের আবেদন ফরম</h3>
<div class="card">
    <div class="card-body">
        <h4>পরীক্ষার্থী কর্তৃক পূরণীয়:</h4>
        <div class="card-body">
        <form action="generate_pdf.php" method="post">
    <div class="form-group">
      <label for="department">১। বিভাগ:</label>
      <input type="text" class="form-control" id="department" name="department" placeholder="আপনার বিভাগ লিখুন" required>
    </div>
    <div class="form-group">
      <label for="studentNameBangla">২। নাম (বাংলা):</label>
      <input type="text" class="form-control" id="studentNameBangla" name="studentNameBangla" placeholder="আপনার বাংলা নাম লিখুন" required>
    </div>
    <div class="form-group">
      <label for="studentNameEnglish">৩। নাম (ইংরেজি):</label>
      <input type="text" class="form-control" id="studentNameEnglish" name="studentNameEnglish" placeholder="আপনার ইংরেজি নাম লিখুন" required>
    </div>
    <div class="form-group">
      <label for="fatherName">৪। পিতার নাম:</label>
      <input type="text" class="form-control" id="fatherName" name="fatherName" placeholder="আপনার পিতার নাম লিখুন" required>
    </div>
    <div class="form-group">
      <label for="motherName">৫। মাতার নাম:</label>
      <input type="text" class="form-control" id="motherName" name="motherName" placeholder="আপনার মাতার নাম লিখুন" required>
    </div>
    <div class="form-group">
      <label for="currentSemester">৬। বর্তমান শিক্ষাবর্ষ ও সেমিস্টার:</label>
      <input type="text" class="form-control" id="currentSemester" name="currentSemester" placeholder="আপনার বর্তমান শিক্ষাবর্ষ ও সেমিস্টার লিখুন" required>
    </div>
    <div class="form-group">
      <label for="readmissionSemester">৭। পুনঃ ভর্তি হলে, শিক্ষাবর্ষ ও সেমিস্টার লিখুন (যদি প্রযোজ্য হয়):</label>
      <input type="text" class="form-control" id="readmissionSemester" name="readmissionSemester" placeholder="পুনঃ ভর্তি হলে শিক্ষাবর্ષ ও সেমিস্টার লিখুন (যদি প্রযোজ্য হয়)">
    </div>
    <div class="form-group">
      <label for="examRoll">৮। পরীক্ষার রোল নম্বর:</label>
      <input type="text" class="form-control" id="examRoll" name="examRoll" placeholder="আপনার পরীক্ষার রোল নম্বর লিখুন">
    </div>
    <div class="form-group">
      <label for="examRoll">৯। মোবাইল নম্বর:</label>
      <input type="text" class="form-control" id="examRoll" name="examRoll" placeholder="আপনার মোবাইল নম্বর লিখুন">
    </div>
    
    <label for="examRoll">১০। যে সকল কোর্সে ফলোন্নয়ন/এফ গ্রেড থেকে উন্নয়ন পরীক্ষায় অংশগ্রহণ কতে ইচ্ছুক তার বিবরণ:</label>
    <table class="table table-bordered">
    <thead>
    <tr class="bg-primary text-white">
    <th scope="col">ক্রমিক নং</th>
    <th scope="col">সেমিস্টার</th>
    <th scope="col">কোর্স নং</th>
    <th scope="col">কোর্সের শিরোনাম</th>
    <th scope="col">প্রাপ্ত জিপিএ</th>
</tr>

    </thead>
    <tbody>
      <tr>
        <td><input type="number" class="form-control" name="courseDetails[0][serialNo]" required></td>
        <td><input type="text" class="form-control" name="courseDetails[0][semester]" required></td>
        <td><input type="text" class="form-control" name="courseDetails[0][courseNo]" required></td>
        <td><input type="text" class="form-control" name="courseDetails[0][courseTitle]" required></td>
        <td><input type="text" class="form-control" name="courseDetails[0][gradeObtained]" required></td>
      </tr>
      <tr>
        <td><input type="number" class="form-control" name="courseDetails[1][serialNo]" required></td>
        <td><input type="text" class="form-control" name="courseDetails[1][semester]" required></td>
        <td><input type="text" class="form-control" name="courseDetails[1][courseNo]" required></td>
        <td><input type="text" class="form-control" name="courseDetails[1][courseTitle]" required></td>
        <td><input type="text" class="form-control" name="courseDetails[1][gradeObtained]" required></td>
      </tr>
    </tbody>
  </table>

  <div class="form-group">
    <label for="declaration">বিনীত নিবেদক:</label>
    <textarea id="declaration" name="declaration" rows="4" class="form-control" placeholder="আপনি কেনো অংশগ্রহণ করতে চান,প্রয়োজনীয় কারন লিখুন:" required></textarea>
  </div>
  <div class="form-group">
    <label for="date">তারিখ:</label>
    <input type="date" class="form-control" id="date" name="date" required>
  </div>
  <div class="form-group">
    <label for="signature">স্বাক্ষর:</label>
    <input type="text" class="form-control" id="signature" name="signature" placeholder="আপনার স্বাক্ষর লিখুন" required>
  </div>
</div>
</div>
  <button type="submit" class="btn btn-success">Submit</button>
</form>
<script>
        $(document).ready(function() {
            $('#submissionForm').submit(function(e) {
                e.preventDefault(); // Prevent default form submission

                // Send AJAX request to PHP script to generate PDF
                $.ajax({
                    type: 'POST',
                    url: 'generate_pdf.php', // Change to your PHP script URL
                    data: $(this).serialize(), // Serialize form data
                    success: function(response) {
                        // Handle successful response
                        console.log('PDF generated successfully');
                        // Print the page
                        window.print();
                    },
                    error: function(xhr, status, error) {
                        // Handle error response
                        console.error('Error generating PDF:', error);
                    }
                });
            });
        });
    </script>

</body>
</html>
<?php
    // In generate_pdf.php, process form data and generate PDF
    // If successful, you could redirect the user or display the PDF here
  ?>