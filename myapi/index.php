<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


$method = $_SERVER['REQUEST_METHOD'];
$request = @explode('/', trim($_SERVER['REQUEST_URI'], '/'));
$data = json_decode(file_get_contents("php://input"), true);
$table_name = $request[2] ?? null;
$id = $request[3] ?? null;

switch ($table_name) {
    case 'products':
        include_once 'endPoints/Product.php';
        $table = new Product();
        break;

    case 'users':
        include_once 'endPoints/Users.php';
        $table = new User();
        break;

    case 'images':
        include_once 'endPoints/Image.php';
        $table = new Image();
        break;

    case 'cart':
        include_once 'endPoints/Cart.php';
        $table = new Cart();
        break;

    case 'permission':
    case 'gender':
    case 'category':
    case 'brand':
        include_once 'endPoints/SmallTable.php';
        $table = new SmallTable($table_name);
        break;
    
    default:
        echo json_encode(["message" => "Endpoint not found"]);
        exit();
        break;
}



switch ($method) {
    case 'GET':
        if ($id) $table->getById($id);
        else $table->getAll();
        break;

    case 'POST':
        $table->create($id, $data);
        break;

    case 'PUT':
        $table->update($id, $data);
        break;

    case 'DELETE':
        $table->delete($id);
        break;

    default:
        echo json_encode(["message" => "Method not allowed"]);
        break;
}
?>
