<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer</title>
    <style>
        /* Basic styling for the footer and modal */
        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: #f8f9fa; /* Fixed missing semicolon and added color */
            color: blue;
            text-align: center;
            padding: 10px;
            margin-top: 20px;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 800px; /* Increased max-width for larger screens */
            position: relative;
        }

        .close {
            color: #aaa;
            position: absolute;
            top: 10px;
            right: 20px;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .developer-info {
            display: flex;
            flex-wrap: wrap; /* Allow wrapping on smaller screens */
            justify-content: space-between;
            text-align: left;
        }

        .developer {
            width: 30%;
            text-align: center;
            margin-bottom: 20px; /* Add margin for spacing */
        }

        .developer img {
            border-radius: 50%;
            width: 100px;
            height: 100px;
        }

        /* Adjusting the spacing between paragraphs */
        .developer p {
            margin: 2px 0; /* Reduced margin for less spacing */
        }

        /* Styling for the horizontal line */
        .footer hr {
            border: 0;
            height: 1px;
            background: #ccc;
            margin: 0; /* Remove margin for better alignment */
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .developer {
                width: 100%; /* Full width on smaller screens */
                margin: 10px 0; /* Add margin for spacing */
            }

            .modal-content {
                width: 90%; /* Wider on mobile devices */
            }
        }

        /* Desktop adjustments */
        @media (min-width: 769px) {
            .developer {
                width: 30%; /* Maintain 30% width for desktop */
            }

            .modal-content {
                width: 80%; /* Wider on desktop */
            }
        }
    </style>
</head>
<body> 

<div class="footer mt-4">
    <hr>
    &copy; <strong><span>© <?php echo date('Y'); ?> Dept of CSE, JKKNIU.</span></strong>. All Rights Reserved | <strong><span></span><a href="#" id="modalLink" style="color: green;">Developed by</a></span></strong>
</div>

<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close">×</span>
        <h2>Developer Information</h2>
        <div class="developer-info">
            <div class="developer">
                <img src="images/jannat.jpg" alt="Prof. Dr. Mst. Jannatul Ferdous">
                <p><strong>Prof. Dr. Mst. Jannatul Ferdous</strong></p>
                <p>Supervisor</p>
                <p>Dept. of CSE, JKKNIU</p>
                <p>mjferdous_cse@jkkniu.edu.bd</p>
                <p>01710695925</p>
            </div>
            <div class="developer">
                <img src="images/taher.png" alt="Md Abu Taher">
                <p><strong>Md Abu Taher</strong></p>
                <p style="color:blueviolet">PHP Laravel and Vue Js Developer</p>
                <p>Dept. of CSE, JKKNIU</p>
                <p>Session: 2019-20</p>
                <p>abutahercse3255@gmail.com</p>
                <p>01645787748</p>
            </div>
            <div class="developer">
                <img src="images/monir.jpg" alt="Moniruzzaman Monir">
                <p><strong>Md. Moniruzzaman Monir</strong></p>
                <p>Developer</p>
                <p>Dept. of CSE, JKKNIU</p>
                <p>Session: 2019-20</p>
                <p>mmmonir293@gmail.com</p>
                <p>01997638205</p>
            </div>
        </div>
    </div>
</div>

<script>
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the link that opens the modal
    var link = document.getElementById("modalLink");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks the link, open the modal 
    link.onclick = function() {
        modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>

</body>
</html>
