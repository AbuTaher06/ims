<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer with Developer Information</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<section id="footer" class="p-0 fixed-bottom" style="background-color: black;">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 mt-0 mt-sm-0 text-center text-white">
                <small>© 2024 Dept of CSE, JKKNIU. All Rights Reserved.
                    <button type="button" class="btn btn-sm mb-1 text-warning text-decoration-underline" data-toggle="modal" data-target="#developerModal">
                        Developed By
                    </button>
                </small>
            </div>
        </div>
    </div>
</section>

<!-- Developer Modal -->
<div class="modal fade" id="developerModal" tabindex="-1" role="dialog" aria-labelledby="developerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <h1 class="modal-title fs-5 text-dark" id="developerModalLabel">Developers</h1>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center text-dark list-none">
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    <div class="col">
                        <div class="card border-0">
                            <img style="border-radius: 20%;" src="./images/sujan_sir.jpg" class="w-50 pt-1 m-auto card-img-top" alt="...">
                            <div class="card-body lh-1">
                                <h6 class="text-bold">Prof. Dr. Sujan Ali</h6>
                                <p class="text-bold"> <span class="bg-gray rounded-3 p-1">Supervisor</span></p>
                                <p class="">Dept. of CSE, JKKNIU</p>
                                <p class=""><i class="fa fa-envelope"></i> sujan@gmail.com</p>
                                <p class=""><i class="fa fa-phone"></i> 01xxxxxxx</p>
                                <p></p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card border-0">
                            <img style="border-radius: 50%;" src="./images/taher.png" class="w-50 pt-1 m-auto card-img-top" alt="...">
                            <div class="card-body lh-1">
                                <h6 class="text-bold">Md Abu Taher</h6>
                                <p class="text-bold"> <span class="bg-gray rounded-3 p-1">Student</span></p>
                                <p class="">Dept. of CSE, JKKNIU</p>
                                <p class=""><i class="fa fa-graduation-cap"></i> session: 2019-20</p>
                                <p class=""><i class="fa fa-envelope"></i> abutahercse3255@gmail.com</p>
                                <p class=""><i class="fa fa-phone"></i> 01645787748</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card border-0">
                            <img style="border-radius: 50%;" src="./images/default.png" class="w-50 pt-1 m-auto card-img-top" alt="...">
                            <div class="card-body lh-1">
                                <h6 class="text-bold">Suraiya Akter</h6>
                                <p class="text-bold"> <span class="bg-gray rounded-3 p-1">Student</span></p>
                                <p class="">Dept. of CSE, JKKNIU</p>
                                <p class=""><i class="fa fa-graduation-cap"></i> session: 2019-20</p>
                                <p class=""><i class="fa fa-envelope"></i> suraiya@gmail.com</p>
                                <p class=""><i class="fa fa-phone"></i> 01xxxxxxx</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap and jQuery Scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
