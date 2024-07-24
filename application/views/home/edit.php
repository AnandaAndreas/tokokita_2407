<div class="container-fluid pt-5">
  <div class="text-center mb-4">
    <h2 class="section-title px-5"><span class="px-2">Form Edit Profil Member</span></h2>
  </div>
  <div class="row px-xl-5">
    <div class="col-lg-7 mb-5">
      <div class="contact-form">
        <form name="sentMessage" method="post" action="<?php echo site_url('main/edit_member'); ?>">
          <input type="hidden" name="idKonsumen" class="form-control" id="name" placeholder="Nama" required="required" data-validation-required-message="Please enter your name" value="<?php echo $profil->idKonsumen ?>" />
          <div class="control-group">
            <input type="text" name="nama" class="form-control" id="name" placeholder="Nama" required="required" data-validation-required-message="Please enter your name" value="<?php echo $profil->namaKonsumen ?>" />
            <p class="help-block text-danger"></p>
          </div>
          <div class="control-group">
            <input type="text" name="email" class="form-control" id="emfail" placeholder="Email" required="required" data-validation-required-message="Please enter your email" value="<?php echo $profil->email ?>" />
            <p class="help-block text-danger"></p>
          </div>
          <div class="control-group">
            <input type="text" name="telpon" class="form-control" id="email" placeholder="No Telepon" required="required" data-validation-required-message="Please enter your email" value="<?php echo $profil->tlpn ?>" />
            <p class="help-block text-danger"></p>
          </div>
          <div class="control-group">
            <input type="text" name="alamat" class="form-control" id="email" placeholder="alamat" required="required" data-validation-required-message="Please enter your email" value="<?php echo $profil->alamat ?>" />
            <p class="help-block text-danger"></p>
          </div>
          <div>
            <button class="btn btn-primary py-2 px-4" type="submit" id="sendMesrsageButton">Edit</button>
          </div>
        </form>
      </div>
    </div>

  </div>
</div>
