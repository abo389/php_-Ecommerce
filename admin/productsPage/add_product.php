<form action="./productsPage/do_add.php" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <input  name="name" type="text" class="form-control" placeholder="product name">
  </div>
  <div class="form-group">
    <input  name="price" type="number" class="form-control" placeholder="product price">
  </div>
  <div class="form-group">
    <input  name="count" type="number" class="form-control" placeholder="product count">
  </div>
  <div class="form-group">
    <input  name="description" type="text" class="form-control" placeholder="product description">
  </div>
  <div class="form-group">
    <label>product catagory</label>
    <select  class="form-control" name="cat">
    <?php
      $data = $conn->query("SELECT * FROM category")->fetch_all(MYSQLI_ASSOC);
      print_r($data);
      foreach($data as $v) {
        echo "<option value='$v[id]'>$v[name]</option>";
      }
      ?>
  </select>
  </div>
  <div class="form-group">
    <label>product brand</label>
    <select  class="form-control" name="brand">
      <?php
      $data = $conn->query("SELECT * FROM brand")->fetch_all(MYSQLI_ASSOC);
      print_r($data);
      foreach($data as $v) {
        echo "<option value='$v[id]'>$v[name]</option>";
      }
      ?>
    </select>
  </div>
  <div class="form-group">
    <input name="image" class="form-control-file" type="file" placeholder="product image">
  </div>

  <button type="submit" class="btn btn-primary">Add</button>
</form>