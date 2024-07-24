<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .stars a {
            display: inline-block;
            padding-right: 4px;
            text-decoration: none;
            margin: 0;
        }
        
        .stars a:after {
            position: relative;
            font-size: 18px;
            font-family: 'FontAwesome', serif;
            display: block;
            content: "\f005";
            color: #9e9e9e;
        }
        
        span {
            font-size: 0;
            /* trick to remove inline-element's margin */
        }
        
        .stars a:hover~a:after {
            color: #9e9e9e !important;
        }
        
        span.active a.active~a:after {
            color: #9e9e9e;
        }
        
        span:hover a:after {
            color: blue !important;
        }
        
        span.active a:after,
        .stars a.active:after {
            color: blue;
        }
    </style>
<div class="container-fluid pt-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">Form Tambah Toko</span></h2>
        </div>
        <?php echo $this->session->flashdata('pesan');?>
        <div class="row px-xl-5">
            <div class="col-lg-7 mb-5">
                <div class="contact-form">   
                    <form name="sentMessage"  method="post" action="<?php echo site_url('detail_order/save');?>" enctype="multipart/form-data">
                        <div class="control-group">
                            <p class="stars">
                                <span>
                                <a class="star-1" href="#">1</a>
                                <a class="star-2" href="#">2</a>
                                <a class="star-3" href="#">3</a>
                                <a class="star-4" href="#">4</a>
                                <a class="star-5" href="#">5</a>
                                </span>
                            </p>
                            <textarea class="form-control" rows="3" id="message" name="ulasan_ranting" placeholder="Beri Ulasan"   
                                data-validation-required-message="Please enter your message" ></textarea>
                            <p class="help-block text-danger"></p>
                        </div>
                        <div>
                            <button class="btn btn-primary py-2 px-4" type="submit" id="sendMesrsageButton">kirim</button>
                        </div>
                    </form>
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                        <script>
                            $('.stars a').on('click', function() {
                            $('.stars span, .stars a').removeClass('active');
                            $(this).addClass('active');
                            $('.stars span').addClass('active');
                            });
                        </script>
                </div>
            </div>
        </div>
    </div>

    
    
    
    
    
    



<!-- <form method="post">
    <div class="container">
    <input type="text" name="resi_ekpedisi" class="form-control" action="<?php echo site_url('main/ulasan'); ?>">
    <button class="btn btn-primary">kirim</button>
    </div>
</form> -->

<!-- <div class="container">

    <h6 class="mt-5 mb-3">Beri Ulasan</h6>
    <div class="mb-2">
    <p class="stars">
    <span>
    <a class="star-1" href="#">1</a>
    <a class="star-2" href="#">2</a>
    <a class="star-3" href="#">3</a>
    <a class="star-4" href="#">4</a>
    <a class="star-5" href="#">5</a>
    </span>
    </p>
    <textarea class="form-control" name="ulasan_ranting"></textarea>
    
</div>
</div>
</form> -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script>
        $('.stars a').on('click', function() {
            $('.stars span, .stars a').removeClass('active');

            $(this).addClass('active');
            $('.stars span').addClass('active');
            
        });
    </script>
 -->


