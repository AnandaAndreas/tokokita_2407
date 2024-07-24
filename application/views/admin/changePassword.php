<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
             <div class="col-sm-6">
                <h1>Form Ganti Password</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Ganti Password</li>
                </ol>
            </div>
        </div>
</div>
</section>
<section class="content">
<div class="container-fluid">
<div class="row">
<div class="col-md-6">
<div class="card card-info">
<div class="card-header">
<h3 class="card-title">Ganti Password</h3>
</div>
<form class="form-horizontal" method="post" action="<?php echo site_url('adminpanel/ganti_password')?>">
    <input type="hidden" name="id">
    <div class="card-body">
        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">New Password</label>
            <div class="col-sm-9">
                <input type="password" name="newPassword" class="form-control"
                    id="inputEmail3" placeholder="Confirm New Password">
            </div>
        </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <button type="submit" class="btn btn-info float-right">Simpan</button>
    </div>
    <!-- /.card-footer -->
</form>
</div>
</div>
</div>
</div>
</section>
</div>