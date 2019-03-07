<?php

session_start();
require_once("db.php");


if(isset($_GET['action']))
{
    if($_GET['action']=='add') {
    
    //Finding the item by code
    
    $query = "SELECT * FROM items WHERE id=".$_POST['id']."";
    $result = mysqli_query($conn,$query);
    $item = mysqli_fetch_array($result);
    
    $item_quantity = $_SESSION['items'][$_POST['id']]['quantity']+1;
    $_SESSION['items'][$_POST['id']] =array('id_item'=>$_POST['id'],
                                            'quantity'=>$item_quantity,
                                            'name'=>$item['name'],
                                            'price'=>$item['price']);
    $_SESSION["item_added"]=true;
    $item='';
    header("Location: index.php");
    exit();
}

//Empty one by one
if($_GET['action']=='delete') {
    $id = $_GET['id'];
    unset($_SESSION['items'][$id]);
    echo '<script>alert("Item Removed")</script>';
    echo '<script>window.location="shopping_cart.php"</script>';
}

$query = "SELECT * FROM items";
$stmt = $conn->prepare($query);
$stmt->execute();
$items = $stmt->fetchAll();
} 
?>