<?php include('header.php');

?>

<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-body">
      <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
          <div class="card">
            <div class="card-header">
              <h4>Product Insert</h4>
            </div>
            <form method="post" enctype="multipart/form-data">
              <div class="card-body">
                <div class="form-group">
                  <label>Product Name </label>
                  <input type="text" name="P_name" class="form-control">
                </div>
                <div class="form-group">
                  <label>Descirption</label>
                  <textarea name="P_des" class="form-control"></textarea>
                </div>
                <div class="form-group">
                  <label>Price </label>
                  <input type="text" name="P_price" class="form-control">
                </div>

                <div class="form-group">
                  <label>Quantity</label>
                  <input type="text" name="P_quantity" class="form-control">
                </div>

                <div class="section-title"> Image</div>
                <div class="custom-file">
                  <input type="file" class="form-control" name="image" id="customFile">

                </div>
                <div class="form-group">
                  <label>Size</label>
                  <input type="text" name="P_size" class="form-control">
                </div>

                <div class="form-group">
                  <label>Colour</label>
                  <input type="text" name="P_colour" class="form-control">
                </div>

                <div class="form-group">


                  <label>Subcategory Name</label>
                  <select class="form-control" name="Sub_C_id">
                    <?php
                    $sql = "select * from `sub-category`";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_array($result)) {
                    ?>
                      <option value="<?php echo $row['Sub_C_id'];
                                      echo $row['Sub_C_name'] ?>"><?php echo $row['Sub_C_name']; ?>
                      <?php
                    }
                      ?>
                  </select>

                </div>
                <div class="form-group">


                  <label>Brand Name</label>
                  <select class="form-control" name="brand_id">
                    <?php
                    $sql3 = "select * from `brand`";
                    $result3 = mysqli_query($conn, $sql3);
                    while ($row3 = mysqli_fetch_array($result3)) {
                    ?>
                      <option value="<?php echo $row3['Brand_id'];
                                      echo $row3['Brand_name'] ?>"><?php echo $row3['Brand_name']; ?>
                      <?php
                    }
                      ?>
                  </select>

                </div>

                <div>
                  <button class="btn btn-primary mr-1" type="submit">Submit</button>
                  <button class="btn btn-secondary" type="reset">Reset</button>
            </form>
          </div>
        </div>

      </div>
    </div>
</div>
</div>
</div>
</section>
<?php
require_once("../config/connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (
    isset($_POST['P_name']) && isset($_POST['P_des']) && isset($_POST['P_price']) && isset($_FILES['image']) &&
    isset($_POST['P_size']) && isset($_POST['P_colour']) && isset($_POST['P_quantity']) && isset($_POST['brand_id'])
    && isset($_POST['Sub_C_id'])
  ) {
    $P_name = $_POST['P_name'];
    $P_des = $_POST['P_des'];
    $P_price = $_POST['P_price'];

    $P_size = $_POST['P_size'];
    $P_colour = $_POST['P_colour'];
    $brand_id = $_POST['brand_id'];
    $Sub_C_id = $_POST['Sub_C_id'];
    $P_quantity = $_POST['P_quantity'];
    $file_name = $_FILES['image']['name'];
    $file_tmp = $_FILES['image']['tmp_name'];
    // $p_img=$_POST['image'];


    if (
      move_uploaded_file($file_tmp, "../Images/" . $file_name) == 1
    ) {
      $sql = "INSERT INTO product(P_name,P_des,P_price,P_quantity,P_Size,P_colour,Sub_C_id,Brand_id,P_image) 
				values('" . $P_name . "','" . $P_des . "','" . $P_price . "','" . $P_quantity . "','" . $P_size . "','" . $P_colour . "','" . $Sub_C_id . "','" . $brand_id . "','" . $p_img . "')";

      $result = mysqli_query($conn, $sql);

      if ($result) {
        echo "Success";
      } else {
        echo "Insertion failed: " . mysqli_error($conn);
      }
    }
  }
}

?>

</div>
</div>

</div>
</div>
</div>
</div>
</div>
</section>



<!-- General JS Scripts -->
<script src="assets/js/app.min.js"></script>
<!-- JS Libraies -->
<!-- Page Specific JS File -->
<!-- Template JS File -->
<script src="assets/js/scripts.js"></script>
<!-- Custom JS File -->
<script src="assets/js/custom.js"></script>



<!-- Mirrored from www.radixtouch.in/templates/admin/otika/source/light/basic-form.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 23 Nov 2019 14:26:53 GMT -->