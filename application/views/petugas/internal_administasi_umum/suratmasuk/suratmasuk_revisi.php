<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view("petugas/_partials/head.php") ?>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <?php $this->load->view("petugas/_partials/navbar.php")?>
        <!-- Content Wrapper. Contains page content -->
        <?php $this->load->view("petugas/_partials/sidebar.php")?>

        <div class="content-wrapper">
        <?php $this->load->view("petugas/_partials/breadcrumb.php")?>


            <section class="content">
                <div class="container-fluid" style="max-width: 100%;">
                    <!-- Small boxes (Stat box) -->
                    <div class="card">
                        <div class="card-header bg-dark">
                            <div class="card-title ">
                            <span>Patty Cash Revisi</span>
                            </div>
                        </div>
                        <div class="card-body">
                                
                            <div class="box">
                                <!-- /.box-header -->
                                <div class="box-body">

                                        <table class="table table-bordered">
                                            <tbody>
                                                
                                                <tr>
                                                    <th>Status Kesalahan</th>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <th>No Quotation</th>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <th>No Order</th>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <th>File Quotation PDF</th>
                                                    <td></td>
                                                    <td><button class="ml-3 btn btn-primary btn-sm">Download File</button></td>
                                                </tr>
                                                
                                                
                                                <tr>
                                                    <th>Action</th>
                                                    <td> 
                                                        <div class="justify-content-center"> 
                                                            
                                                                <button class="btn btn-primary" id="quo-failed">Draft Create</button> 
                                                        </div>
                                                    </td>
                                                    <td></td>
                                                </tr>  
                                            </tbody>
                                        </table>

                                       


                                        <!-- Quotation Revisi -->
                                        <div class="row justify-content-center mt-4">
                                            <div class="col-12">  
                                                <div class="card" style="display:none;" id="quoFailed">
                                                    <div class="card-header bg-primary">
                                                        <div class="card-title">
                                                            <span>Send Quotation Refisi ke <?=$this->fungsi_send->sendreceiverRka1()?></span>
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <form action="">
                                                            <input type="text" name="send_up" id="send_up" value="send_up">
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">Revisi</label>
                                                                <input type="text" name="revisi" class="form-control" id="revisi" value="revisi" >
                                                            </div>
                                                           
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">Budget ID</label>
                                                                <input type="text" name="suratmasukNo" class="form-control" id="suratmasukNo" value="<?=$row->suratmasukNo?>" >
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">budget File</label>
                                                                <input type="file" name="smFile" class="form-control" id="smFile" value="">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">Comment</label>
                                                                <textarea name="" id="" class="form-control" cols="30" rows="10"></textarea>
                                                            </div> 
                                                            <div>
                                                                <p> <span class="text-danger">*</span><span> Membuat Revisi Untuk mengirimkan ke </span></p>
                                                            </div> 
                                                            <button type="submit" name="kirim-revisi" id="kirim-revisi" class="btn btn-primary">Kirim</button>
                                                            <button type="reset" class="btn btn-secondary">Reset</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Quotation Revisi -->

                                        

                                </div>
                                <!-- /.box-body -->
                            </div>   
                        </div>                          
                    </div>
                    <!-- /.row (main row) -->
                </div><!-- /.container-fluid -->
            </section>

        </div>



    <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
            </div>
        </div>
        </div>
    <!-- Modal End-->


        <!-- /.content-wrapper -->
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
        <!-- Main Footer -->
        <?php $this->load->view("petugas/_partials/footer.php") ?>
    
    </div>
<!-- ./wrapper -->

<!-- Javascript -->
<?php $this->load->view("petugas/_partials/js.php") ?>



<script>

$(document).ready(function(){

$('#quo-success').on('click', function(){
    $('#quoFailed').hide("slow");
    $('#quoSukses').show("slow");
});

$('#quo-failed').on('click', function(){
    $('#quoSukses').hide("slow");
    $('#quoFailed').show("slow");
    
});

//Membuat dan mengirimkan file Refisi pengirimannya ke atas




//Melanjutkan File Failed Ke Orang Di bawah
$('#kirim-revisi').on('click', function(e){

    e.preventDefault();


    var myformData = new FormData();        
    myformData.append('send_up',  $('#send_up').val());
    myformData.append('revisi',  $('#revisi').val());
    myformData.append('suratmasukNo',  $('#suratmasukNo').val());
    myformData.append('smFile', $('#smFile')[0].files[0]);

    // console.log(myformData);


    $.ajax({
        type : "POST",
        url  : "<?php echo base_url('IntAdministrasi/addSuratMasuk')?>",
        dataType : "JSON",
        data : myformData,
        contentType: false,
        processData: false,
        cache: false,
        enctype: 'multipart/form-data',
        success: function(response){
            console.log(response);
            // if(response.status == 'success'){
            //     console.log("sukses");
            //     $('.quoID').html("");
            //     $('.orderID').html("");
            //     Swal.fire({
            //         icon: 'success',
            //             title: 'File Berhasil Di Kirim!',
            //             text: 'You clicked the button!',
                
            //     }).then(function() {
            //         window.location.assign("<?php echo base_url();?>IntPengadaanBarang/viewFailedPettyCash/");
            //     });
            
            // }else{
            //     $('.quoID_error').html(response.quoID);
            //     $('.orderID_error').html(response.orderID);
            // }   
        }
    });
    return false;
    });





});


</script>





</body>

</html>