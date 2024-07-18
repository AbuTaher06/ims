<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Request for Improvement</title>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    </head>

    <body>
        <?php
        include("header.php");

        
        ?>

        <div class="container-fluid">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-2" style="margin-left:-30px;">
                    <?php
                                include("sidenav.php");
                    ?>

                    </div>
                    <div class="col-md-10">
                            <h5 class="text-center my"> Requested for Improvement</h5>
                            <div id="show"></div>
                    </div>

                </div>
            </div>
        </div>


    <script type="text/javascript">
    $(document).ready(function(){

        show();
        function show(){
            $.ajax({
                url:"improve_request.php",
                method:"POST",
                success:function(data){
                    $("#show").html(data);
                }
            });
        }

        $(document).on('click','.approve',function(){
                    var id=$(this).attr("id");
                    $.ajax({
                        url:"improve_approve.php",
                        method:"POST",
                        data:{id:id},
                        success:function(data){
                            show();
                        }
                    });
        });

        $(document).on('click','.reject',function(){
                    var id=$(this).attr("id");
                    $.ajax({
                        url:"improve_reject.php",
                        method:"POST",
                        data:{id:id},
                        success:function(data){
                            show();
                        }
                    });
        });
    });
</script>
<?php 
include("../footer.php");
?>
    </body>
</html>