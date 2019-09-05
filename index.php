<?php
$customer_List = array(
    "1" => array("name" => "Đỗ Thị Thanh",
        "day_of_birth" => "1998/08/20",
        "address" => "Hà Nội",
        "image" => "images/customer1.jpg"),
    "2" => array("name" => "Lê Thị Hoa",
        "day_of_birth" => "1997/03/21",
        "address" => "Thái Bình",
        "image" => "images/customer2.jpg"),
    "3" => array("name" => "Đỗ Thị Hồng",
        "day_of_birth" => "1993/07/23",
        "address" => "Bắc Giang",
        "image" => "images/customer3.jpg"),
    "4" => array("name" => "Nguyễn Thị Thanh",
        "day_of_birth" => "2000/08/29",
        "address" => "Hà Nội",
        "image" => "images/customer4.jpg")
);
function searchByDate($customers, $from_date, $to_date) {
    if(empty($from_date) && empty($to_date)){
        return $customers;
    }
    $filtered_customers = [];
    foreach($customers as $customer){
        if(!empty($from_date) && (strtotime($customer['day_of_birth']) < strtotime($from_date)))
            continue;
        if(!empty($to_date) && (strtotime($customer['day_of_birth']) > strtotime($to_date)))
            continue;
        $filtered_customers[] = $customer;
    }
    return $filtered_customers;
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php
$from_date = NULL;
$to_date = NULL;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $from_date = $_POST["from"];
    $to_date = $_POST["to"];
}
$filtered_customers = searchByDate($customer_List, $from_date, $to_date);
?>
<form method="post">
    Từ: <input id = "from" type="text" name="from" placeholder="yyyyy/mm/dd" value="<?php echo isset($from_date)?$from_date:''; ?>"/>
    Đến: <input id = "to" type="text" name="to" placeholder="yyyy/mm/dd" value="<?php echo isset($to_date)?$to_date:''; ?>"/>
    <input type = "submit" id = "submit" value = "Lọc"/>
</form>

<table border="1" style="border-color:pink">
    <caption><h2>Danh sách khách hàng</h2></caption>
    <tr>
        <th>STT</th>
        <th>Tên</th>
        <th>Ngày sinh</th>
        <th>Địa chỉ</th>
        <th>Ảnh</th>
    </tr>
    <?php foreach($filtered_customers as $index=> $customer): ?>
        <tr>
            <td><?php echo $index + 1;?></td>
            <td><?php echo $customer['name'];?></td>
            <td><?php echo $customer['day_of_birth'];?></td>
            <td><?php echo $customer['address'];?></td>
            <td><div class="profile"><img src="<?php echo $customer['image'];?>" width ='90px' height ='80px'/></div> </td>
        </tr>
    <?php endforeach; ?>
</table>
</body>
</html>
