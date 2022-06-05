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
                        <div class="card-body p-0">
                                
                            <div class="box">
                                <!-- /.box-header -->
                                <div class="box-body">

                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <th>ID Pengeluaran</th>
                                                    <td><?=$row->pengeluaranID?></td>
                                                </tr>
                                                <tr>
                                                    <th>ID Budget Honor</th>
                                                    <td><?=$row->budgethonorNo?></td>
                                                </tr>
                                                <tr>
                                                    <th>Pengirim</th>
                                                    <td><?=$row->aproval_pengirimID?></td>
                                                </tr>
                                                <tr>
                                                    <th>File Approval</th>
                                                    <td><a class="btn btn-primary btn-sm" href="<?php echo base_url().'uploads/honorarium/pencairanBudget/'.$row->aprovalFile;?>"> Download</a> <?=$row->aprovalFile?>  </td>
                                                </tr>
                                                
                                                <tr>
                                                    <th>Action</th>
                                                    <td> 
                                                        <div class="justify-content-center"> 
                                                            
                                                                <a href="<?=site_url('IntHonorarium/viewAddInventaris/').$row->approvDetailID?>"><button class="btn btn-success mr-3" id="quo-success">INVENTARIS</button></a>
                                                            
                                                        </div>
                                                    </td>
                                             
                                                </tr>  
                                            </tbody>
                                        </table>


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



$('#success').on('click', function(){
        // e.preventDefault();

        $.ajax({
            type : "POST",
            url  :"<?php echo base_url('IntPengadaanBarang/uploadBreakdown')?>",
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
                    
                    });
                    // .then(function() {
                    //     window.location.assign("<?php echo base_url();?>WorkflowQuotation/viewNewQuo/");
                    // });
                   
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

    // console.log(a);

    // var myformData = {
    //     'jobdescID'       : $('input[name=jobdescID]').val(),
    //     'spkID'           : $('#spkID').val(),
    //     'fileSpk'         : $('#fileSpk')[0].files[0],
    //     'filebiayasurvey' :  $('#filebiayasurvey')[0].files[0]
    // }

    var myformData = new FormData();        
    myformData.append('send_down',  $('#send_down').val());
    
    myformData.append('failed',  $('#failed').val());
    myformData.append('budgetHID',  $('#budgetHID').val());
    myformData.append('budgetHFile', $('#budgetHFile')[0].files[0]);

    // console.log(myformData);


    $.ajax({
        type : "POST",
        url  : "<?php echo base_url('IntHonorarium/addBudgetHonor')?>",
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
                
                })
                // .then(function() {
                //     window.location.assign("<?php echo base_url();?>IntPengadaanBarang/viewNewPettyCash/");
                // });
            
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