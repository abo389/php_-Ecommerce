<table class="table">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">name</th>
      <th scope="col">price</th>
      <th scope="col">image</th>
      <th scope="col">catagory</th>
      <th scope="col">brand</th>
      <th scope="col">views</th>
      <th scope="col">count</th>
      <th scope="col">description</th>
      <th scope="col">controls</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    $select = "SELECT p.id, p.name, p.price, `image`, c.name as cat, b.name as brand, `count`, `description`, `views`
              FROM `products` p,`category` c,`brand` b 
              WHERE p.cat = c.id AND p.brand = b.id;";
    $data = $conn->query($select)->fetch_all(MYSQLI_ASSOC);
    // echo "<pre>";
    // print_r($data);
    // echo "</pre>";
    foreach ($data as $r) {
      echo "
          <tr>
            <th scope='row'>$r[id]</th>
            <td>$r[name]</td>
            <td>$r[price]</td>
            <td><img style='width: 100px;' src='./images/$r[image]'></td>
            <td>$r[cat]</td>
            <td>$r[brand]</td>
            <td>$r[views]</td>
            <td>$r[count]</td>
            <td style='width: 300px;'>".substr($r['description'],0,60)."<a href='#'>  See More</a>"."</td>
            <td>
            <a class='btn btn-primary' href='?action=edit&id=$r[id]'>Edit</a>
            <a class='btn btn-danger' href='productsPage/do_delete.php?id=$r[id]'>Delete</a>
            </td>
          </tr>
      ";
    };
    ?>

  </tbody>
</table>

<a href="?action=add" class="btn btn-primary">Add new project</a>