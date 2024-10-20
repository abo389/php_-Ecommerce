<?php
$conn = new mysqli("localhost","root","","ecommers");
$id = $_GET["id"];
$select = "SELECT * FROM products WHERE id='$id'";
$old_data = $conn->query($select)->fetch_assoc();
?>

<form action="./productsPage/do_edit.php?id=<?=$id?>" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <input value="<?= $old_data['name'] ?>" required name="name" type="text" class="form-control" placeholder="product name">
  </div>
  <div class="form-group">
    <input value='<?= $old_data["price"] ?>' required name="price" type="number" class="form-control" placeholder="product price">
  </div>
  <div class="form-group">
    <input value='<?= $old_data["count"] ?>' required name="count" type="number" class="form-control" placeholder="product count">
  </div>
  <div class="form-group">
    <textarea required name="description" type="text" class="form-control" rows="3" placeholder="product description">
    <?= $old_data["description"] ?>
    </textarea>
  </div>
  <div class="form-group">
    <label>product catagory</label>
    <select required class="form-control" name="cat">
    <?php
      $data = $conn->query("SELECT * FROM category")->fetch_all(MYSQLI_ASSOC);
      foreach($data as $v) {
        $m = ($v["id"] === $old_data["cat"]) ? 'selected' : "";
        echo "<option $m value='$v[id]'>$v[name]</option>";
      }
      ?>
  </select>
  </div>
  <div class="form-group">
    <label>product brand</label>
    <select required class="form-control" name="brand">
      <?php
      $data = $conn->query("SELECT * FROM brand")->fetch_all(MYSQLI_ASSOC);
      foreach($data as $v) {
        $m = ($v["id"] === $old_data["brand"]) ? 'selected' : "";
        echo "<option $m value='$v[id]'>$v[name]</option>";
      }
      ?>
    </select>
  </div>
  <div class="form-group">
    
    <input type="file" name="image" placeholder="product image">
    <img src='<?="images/$old_data[image]"?>' height="200"/>
  </div>

  <button type="submit" class="btn btn-primary">Update</button>
</form>