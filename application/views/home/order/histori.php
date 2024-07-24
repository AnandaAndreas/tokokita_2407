<div class="container-fluid pt-5">
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">Histori Penjualan</span></h2>
    </div>
    <?php echo $this->session->flashdata('pesan');?>
    <div class="row px-xl-5">
        <div class="col-lg-12 mb-5">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Status Order</th>
                        <th scope="col">Kurir</th>
                        <th scope="col">Ongkir</th>
                        <th scope="col">Total Harga</th>
                        <th style="width: 200px">Resi</th>
                        
                    </tr>
                </thead>
                <tbody>          
                    <?php $no=1; foreach($order as $val){?>
                    <tr>
                       <td><?php echo $no; ?></td>
                       <td> <?php echo $val->tglOrder; ?></td>
                       <td> <?php echo $val->statusOrder; ?> </td>
                       <td> <?php echo $val->kurir; ?></td>
                       <td> <?php echo $val->ongkir; ?></td>
                       <td> <?php echo $val->total; ?></td> 
                       <td>
                        <form method="post" action="<?php echo site_url('detail_order/kirim');?>">
                          <div class="input-group">
                            <input type="text" name="resi_ekpedisi" class="form-control">
                            <button class="btn btn-primary">Kirim</button>                    
                          </div>
                        </form>
                       </td>                            
                       </td>
                    </tr>
                    <?php $no++; }?>   
                </tbody>
            </table>
        </div>
    </div>
</div>

