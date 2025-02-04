<div class="container-fluid pt-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">Form Tambah Produk</span></h2>
        </div>
        <div class="row px-xl-5">
            <div class="col-lg-7 mb-5">
                <div class="contact-form">   
                    <form name="sentMessage"  method="post" action="<?php echo site_url('produk/save');?>" enctype="multipart/form-data">
					<input type="hidden" name="idToko" value="<?php echo $idToko; ?>">
					<div class="control-group">
                        
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input type="text" name="namaProduk" class="form-control" id="name" placeholder="Nama Produk"
                                required="required" data-validation-required-message="Please enter your name" />
                            <p class="help-block text-danger"></p>
                        </div>
				
                        <div class="control-group">
                            <input type="file" name="gambar" class="form-control" id="emfail" placeholder="Gambar Produk"
                                required="required" data-validation-required-message="Please enter your email" />
                            <p class="help-block text-danger"></p>
                        </div>
						<div class="control-group">
                            <input type="text" name="hargaProduk" class="form-control" id="name" placeholder="Harga Produk"
                                required="required" data-validation-required-message="Please enter your name" />
                            <p class="help-block text-danger"></p>
                        </div>
						<div class="control-group">
                            <input type="text" name="jumlahProduk" class="form-control" id="name" placeholder="Jumlah Produk"
                                required="required" data-validation-required-message="Please enter your name" />
                            <p class="help-block text-danger"></p>
                        </div>
						<div class="control-group">
                            <input type="text" name="beratProduk" class="form-control" id="name" placeholder="Berat Produk"
                                required="required" data-validation-required-message="Please enter your name" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <textarea class="form-control" rows="3" id="message" name="deskripsi" placeholder="Deskripsi"
                                required="required"
                                data-validation-required-message="Please enter your message"></textarea>
                            <p class="help-block text-danger"></p>
                        </div>
                        <div>
                            <button class="btn btn-primary py-2 px-4" type="submit" id="sendMesrsageButton">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
