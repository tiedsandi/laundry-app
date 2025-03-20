

<div class="row">
  <div class="col-sm-12">
    <div class="card">
      <div class="card-body">
        <h3><?php echo isset($_GET['edit']) ? 'Edit' : 'Create New' .' '?>Trans Order</h3>
      </div>
      <div class="card-body mt-3">
        <form action="" method="post">
          <div class="row">
            <div class="col-sm-6">
              <div class="mb-3 row">
                <div class="col-sm-3">
                  <label for="">Transaction Code</label>
                </div>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="trans-code" readonly>
                </div>
              </div>
              <div class="mb-3 row">
                <div class="col-sm-3">
                  <label for="">Order Date</label>
                </div>
                <div class="col-sm-5">
                  <input type="date" class="form-control" name="order_date" readonly>
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
                    <option value=""></option>
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
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Service</th>
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