<?php 

  $customersQuery = mysqli_query($conn, "
  SELECT * FROM customer 
  ORDER BY 
      customer_name ASC
  ");
  $rowCustomers = mysqli_fetch_all($customersQuery, MYSQLI_ASSOC);

  $serviceQuery = mysqli_query($conn, "
  SELECT * FROM type_of_service 
  WHERE deleted_at IS NULL OR deleted_at = '0000-00-00 00:00:00'
  ORDER BY 
      service_name ASC
  ");
  $rowServices = mysqli_fetch_all($serviceQuery, MYSQLI_ASSOC);

  $queryTrans = mysqli_query($conn, "
  SELECT max(id) as id_trans FROM trans_order
  ");
  $rowTrans = mysqli_fetch_assoc($queryTrans);
  $id_trans = $rowTrans['id_trans'];
  $id_trans++;

  $kode_transaksi = "TR-" . date("mdy"). sprintf("%03s", $id_trans);

?>

<div class="row">
  <div class="col-sm-12">
    <div class="card">
      <div class="card-body">
        <h3><?php echo isset($_GET['edit']) ? 'Edit' : 'Create New' .' '?>Trans Order</h3>
      </div>
      <div class="card-body mt-3">
        <form action="" method="post">
          <input type="hidden" id="service_price" >
          <div class="row">
            <div class="col-sm-6">

              <div class="mb-3 row">
                <div class="col-sm-3">
                  <label for="">Transaction Code</label>
                </div>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="trans-code" value=<?= $kode_transaksi ?> readonly>
                </div>
              </div>

              <div class="mb-3 row">
                <div class="col-sm-3">
                  <label for="">Order Date</label>
                </div>
                <div class="col-sm-5">
                  <input type="date" class="form-control" name="order_date" >
                </div>
              </div>

              <div class="mb-3 row">
                <div class="col-sm-3">
                  <label for="">Service</label>
                </div>

                <div class="col-sm-5">
                  <select  id="id_service" name="id_service" class="form-control">
                    <option value="" hidden>Choose Service</option>
                    <?php foreach($rowServices as $row): ?>
                      <option value=<?= $row['id']?>>
                        <?= $row['service_name']; ?>
                      </option>
                    <?php endforeach ?>
                  </select>
                </div>
              </div>
            </div>
            
            <div class="col-sm-6">
              <div class="mb-3 row">
                <div class="col-sm-3">
                  <label for="">Customer Name</label>
                </div>
                <div class="col-sm-5">
                  <select name="id_customer" id="" class="form-control">
                    <option value="" hidden>Choose Customer</option>

                    <?php foreach($rowCustomers as $row): ?>
                      <option value=<?= $row['id']?>>
                        <?= $row['customer_name']; ?>
                      </option>
                    <?php endforeach ?>

                  </select>
                </div>
              </div>

              <div class="mb-3 row">
                <div class="col-sm-3">
                  <label for="">Pickup Date</label>
                </div>
                <div class="col-sm-5">
                  <input type="date" class="form-control" name="order_end_date">
                </div>
              </div>
            </div>
          </div>

          <div class="row mt-5">
            <div class="col-sm-12">
              <div align="right" class="mb-3">
                <button type="button" class="btn btn-success btn-sm add-row">Add Row</button>
              </div>
              <table class="table table-bordered table-order">
                <thead>
                  <tr>
                    <th>Service</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Notes</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody></tbody>
              </table>
            </div>
          </div>
          
          <!-- button -->
          <div class="col mb-3">
            <button class="btn btn-primary" type="submit" name="<?php echo isset($_GET['edit']) ? 'edit' : 'save' ?>">Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>