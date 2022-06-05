  
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
    <div class="">

      
       
                <div class="mt-5 container">
                    <form class="form-horizontal">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">IDENTITAS PRIBADI</h3>
                            </div>  
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">No KTP</label>
                                    <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputEmail3" placeholder="No KTP">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">NPWP</label>
                                    <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputEmail3" placeholder="NPWP">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Lengkap</label>
                                    <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputEmail3" placeholder="Nama Lengkap">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">No Telepon</label>
                                    <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputEmail3" placeholder="No Telepon">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Alamat</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="" id="" placeholder="Alamat"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Provinsi</label>
                                    <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputEmail3" placeholder="Provinsi">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Kabupaten</label>
                                    <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputEmail3" placeholder="Kabupaten">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Kota</label>
                                    <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputEmail3" placeholder="Kota">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Kecamatan</label>
                                    <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputEmail3" placeholder="Kecamatan">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Rt/Rw</label>
                                    <div class="col-sm-10 col-md-3"">
                                    <input type="text" class="form-control" id="inputEmail3" placeholder="Rt/Rw">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Kode Pos</label>
                                    <div class="col-sm-10 col-md-3">
                                    <input type="text" class="form-control" id="inputEmail3" placeholder="Kode Pos">
                                    </div>
                                </div>                                                                                                                                                    
                            </div>        
                        </div>

                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">IDENTITAS PERUSAHAAN</h3>
                            </div>                      
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Perusahaan</label>
                                    <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputEmail3" placeholder="Nama Perusahaan">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">No Telepon</label>
                                    <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputEmail3" placeholder="No Telepon">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">No Fax</label>
                                    <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputEmail3" placeholder="No Fax">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Email Perusahaan</label>
                                    <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputEmail3" placeholder="Email Perusahaan">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Alamat</label>
                                    <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputEmail3" placeholder="Alamat Perusahaan">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Provinsi</label>
                                    <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputEmail3" placeholder="Provinsi Perusahaan">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Kota</label>
                                    <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputEmail3" placeholder="Kota Perusahaan">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Kecamatan</label>
                                    <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputEmail3" placeholder="Kecamatan Perusahaan">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Rt/Rw</label>
                                    <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputEmail3" placeholder="Rt/Rw">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Kode Pos</label>
                                    <div class="col-sm-10 col-md-3">
                                    <input type="text" class="form-control" id="inputEmail3" placeholder="Kode Pos">
                                    </div>
                                </div>
                            </div>                           
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-info float-right mx-1">Simpan</button>
                            <button type="submit" class="btn btn-warning float-right mx-1">Reset</button>
                            <button type="submit" class="btn btn-default float-right">Cancel</button>
                        </div>
                    </form>
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


</body>

</html>



