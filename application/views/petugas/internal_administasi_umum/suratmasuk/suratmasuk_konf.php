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
                            <span>Quotaion Cek</span>
                            </div>
                        </div>
                        <div class="card-body">
                                
                            <div class="box">
                                <!-- /.box-header -->
                                <div class="box-body">

                                        <table class="table table-bordered">
                                            <tbody>
                                            <tr>
                                            <input type="text" name="quoDetailID" class="form-control" id="quoDetailID"  value="" >
                                            </tr>
                                                <tr>
                                                    <th>Detail</th>
                                                    <td><button class="btn btn-sm btn-info mr-3">Detail Quotation</button></a></td>
                                                    <td></td>
                                                </tr>
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
                                                    <td> </td>
                                                    <td><button class="ml-3 btn btn-primary btn-sm">Download File</button></td>
                                                </tr>
                                                <tr>
                                                    <th>File Order PDF</th>
                                                    <td></td>
                                                    <td> <button class="ml-3 btn btn-primary btn-sm">Download File</button></td>
                                                </tr>
                                                <tr>
                                                    <th>Waktu</th>
                                                    <td id="waktuTimeout"></td>
                                                </tr>
                                                
                                                <tr>
                                                    <th>Action</th>
                                                    <td> 
                                                        <div class="justify-content-center"> 
                                                            
                                                                <button class="btn btn-success mr-3" id="quo-success">Quotation Success</button> 
                                                 
                                                                <button class="btn btn-danger" id="quo-failed">Quotation Revisi</button> 
                                                        </div>
                                                    </td>
                                                    <td></td>
                                                </tr>  
                                            </tbody>
                                        </table>

                                        <!-- Quotation Success -->
                                        <div class="row justify-content-center mt-4">
                                            <div class="col-12">        
                                                <div class="card"style="display:none;" id="quoSukses">
                                                    <div class="card-header bg-success">
                                                        <div class="card-title">
                                                            <span>Send Quotation Success</span>
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                    
                                                       
                                                        <form action="" id="formAdd">
                                                            <input type="text" name="send_down" id="" value="send_down">
                                                            <input type="text" name="success" class="form-control" id="success" value="success" readonly>
                                                            
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">No RKA</label>
                                                                <input type="text" name="suratmasukNo" class="form-control" id="succes_smID" value="<?=$row->suratmasukNo?>" readonly>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">File RKA Success</label>
                                                                <input type="text" name="smFile_send" class="form-control" id="succes_smFile" value="<?=$row->suratmasukFile?>" readonly>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">Comment</label>
                                                                <textarea name="" id="" class="form-control" cols="30" rows="10"></textarea>
                                                            </div>
                                                            <button type="submit" name="successFile" id="successFile" class="btn btn-success">Kirim</button>
                                                            <button type="reset" class="btn btn-secondary">Reset</button>
                                                   
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>        
                                        </div>
                                        <!-- Quotation Success -->


                                        <!-- Quotation Revisi -->
                                        <div class="row justify-content-center">
                                            <div class="col-12">  
                                                <div class="card" style="display:none;" id="quoFailed">
                                                    <div class="card-header bg-danger">
                                                        <div class="card-title">
                                                            <span>Send Quotation Failed</span>
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <form action="">
                                                            <input type="text" name="send_down" id="send_down" value="send_down">
                                                            <input type="text" name="failed" class="form-control" id="failed" value="failed" readonly>
                                                           
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">No Surat Masuk</label>
                                                                <input type="text" name="suratmasukNo" class="form-control" id="suratmasukNo" value="<?=$row->suratmasukNo?>" >
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">File Revisi</label>
                                                                <input type="file" name="smFile" class="form-control" id="smFile" value="<?=$row->suratmasukFile?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">Comment</label>
                                                                <textarea name="" id="" class="form-control" cols="30" rows="10"></textarea>
                                                            </div> 
                                                                <button type="submit" name="kirim-failed" id="kirim-failed" class="btn btn-primary">Kirim</button>
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


$('#successFile').on('click', function(){
        // e.preventDefault();
      
        $.ajax({
            type : "POST",
            url  :"<?php echo base_url('IntAdministrasi/addSuratMasuk')?>",
            dataType : "JSON",
            data : $('#formAdd').serialize(),
            success: function(response){
                console.log(response);
                if(response.status == 'success'){
                    console.log("sukses");
                    $('.quoID').html("");
                    $('.orderID').html("");
                    Swal.fire({
                        icon: 'success',
                        title: 'File Berhasil Di Kirim!',
                        text: 'You clicked the button!',
                    
                    }).then(function() {
                        window.location.assign("<?php echo base_url();?>IntAdministrasi/viewnewquo/");
                    });
                   
                }else{
                    $('.quoID_error').html(response.quoID);
                    $('.orderID_error').html(response.orderID);
                }
                   
            }
        });

       
        return false;
    });




    //Revisi

    $('#kirim-failed').on('click', function(e){

        e.preventDefault();

        var myformData = new FormData();        
        myformData.append('send_down',  $('#send_down').val());
        myformData.append('failed',  $('#failed').val());
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
                if(response.status == 'success'){
                    console.log("sukses");
                    $('.quoID').html("");
                    $('.orderID').html("");
                    Swal.fire({
                        icon: 'success',
                            title: 'File Berhasil Di Kirim!',
                            text: 'You clicked the button!',
                    
                    }).then(function() {
                        window.location.assign("<?php echo base_url();?>IntAdministrasi/viewnewquo/");
                    });
                
                }else{
                    $('.quoID_error').html(response.quoID);
                    $('.orderID_error').html(response.orderID);
                }   
            }
        });
        return false;
    });


    var set = setInterval(getTimeOut, 1000);
    

    function getTimeOut(){
        var id = $('#quoDetailID').val();
        // console.log(id);
        $.ajax({
            type : "GET",
            url  : "<?php echo base_url('WorkflowQuotation/timeView')?>",
            dataType : "JSON",
            data : {id:id},
            success: function(data){
            console.log(data);
            var now   = new Date();

            var waktuEnd   = new Date(data.waktuEnd);
            var time   = now-waktuEnd;
            var diff_time = Math.abs(time);
            console.log(diff_time);
            // 
            var detik       = Math.round(diff_time/1000);
            console.log(detik);
            var detikx      = detik % 60;
            console.log(detikx);
            var menit       = Math.round(detik/60);
            var menitx      = menit % 60;
            var jam         = Math.round(menit/60);
            var hari        = Math.round(jam/24);
            var minggu      = Math.round(hari/7);
            var waktu;
            var waktux;
            
            if(detik < 60 && detik >=0){
                waktu = detikx + ' Detik';  
            } 
            else if(menit < 60){    
                waktu = menit+' Menit '+detikx+' Detik';
            } 
            else if(jam < 24){
                waktu = jam+'Jam '+menitx+' Menit '+detikx+' Detik ';
            } 
            else if(hari < 7){
                waktu = hari+'d';
            } 
            else{
                waktu = minggu + 'w';
            }

            // console.log(waktu);
            $('#waktuTimeout').html(waktu);

            
            if(now > waktuEnd){
                clearInterval(set);
                
                Swal.fire({
                    icon: 'error',
                        title: 'Data Telah Di Reject!',
                        text: 'You clicked the button!',
                
                }).then(function() {
                    window.location.assign("<?php echo base_url();?>WorkflowQuotation/viewNewQuo/");
                });

            }
               
        }

        });
    }


});


</script>





</body>

</html>