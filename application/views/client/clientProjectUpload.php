<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view("client/_partials/head.php") ?>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <?php $this->load->view("client/_partials/navbar.php")?>
        <!-- Content Wrapper. Contains page content -->
        <?php $this->load->view("client/_partials/sidebar.php")?>

        <div class="content-wrapper">
        <?php $this->load->view("client/_partials/breadcrumb.php")?>
                <div class="m-4">                         
                    <div class="container">
                        <div class="card card-info">
                            <div class="card-header">Order  <?=$data->bidangNama?></div>
                            <div class="card-body">
                                <form action="">
                                
                                    <div class="form-group">
                                        <input type="hidden" name="bidangID" class="form-control bidangID" id="bidangID" value="<?=$data->bidangID?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Upload Dokumen</label>
                                        <input type="file" name="projectFile" class="form-control projectFile" id="projectFile">
                                        <span class="projectFile_error text-danger"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Comment</label>
                                        <textarea class="form-control" name="comment" id="comment"></textarea>
                                        <!-- <span class="fr_lhv_error text-danger"></span> -->
                                    </div>
                                    <a href="<?=base_url()?>client/clientOrder" class="btn btn-secondary">Kembali</a>
                                    <button type="submit" name="add" id="add" class="btn btn-primary">Submit</button>
                               
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        </div>

        <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
        <!-- Main Footer -->
        <?php $this->load->view("client/_partials/footer.php") ?>
    
    </div>
<!-- ./wrapper -->

<!-- Javascript -->
<?php $this->load->view("client/_partials/js.php") ?>



<script>
$(document).ready(function(){

    $('#add').on('click', function(e){
        console.log("add");
        $('.projectFile_error').empty();  
        e.preventDefault();

        var myformData = new FormData(); 
        myformData.append('bidangID', $("#bidangID").val());
        myformData.append('comment', $("#comment").val());
        myformData.append('projectFile', $('#projectFile')[0].files[0]);
        
        $.ajax({
            type : "POST",
            url  :"<?php echo base_url('Client/addProject')?>",
            dataType : "JSON",
            data : myformData,
            contentType: false,
            processData: false,
            cache: false,
            enctype: 'multipart/form-data',
            
            success: function(response){
                console.log(response);
                if(response.status == 'success'){
                    $('.projectFile_error').html("");
                    
                    Swal.fire({
                        icon: 'success',
                        title: 'File Berhasil Di Upload!',
                        text: 'You clicked the button!',
                    }).then(function() {
                        window.location.assign("<?php echo base_url();?>Client/clientDashboard");
                    });
                    

                 } 
                //else{
                //     console.log(response);
                //     $('.projectFile_error').html(response.projectFile);
                // }   
            }
        });
        return false;
    });

});




</script>
</body>

</html>

