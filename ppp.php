<?php 
try {
	$servername = 'localhost';
	$username = 'root';
	$password = '';
	$dbName = 'quanly123';


	$conn = new PDO ("mysql:host=$servername; dbname=$dbName", $username, $password);
	$conn->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (Exception $e) {
	echo "Lỗi Kết Nối" . $e->getMessage();
}

/*Ket noi CSDL*/


$sql = "SELECT * FROM sanpham";
$stmt = $conn->prepare($sql);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$result = $stmt->fetchAll();

/*So san pham tren 1 trang*/
$limit = 4;
/*dem tong so san pham*/

$tong_sanpham = count($result);

/*tong so trang*/

$tongsotrang = ceil($tong_sanpham/$limit);

/*lay ra vi tri trang hien tai*/

$tranghientai = isset($_GET['trang']) ? $_GET['trang'] : 1;

$batdau = ($tranghientai -1) * $limit;

$prev = ($tranghientai -1);
$next = ($tranghientai +1);


$sql1 = "SELECT * FROM sanpham LIMIT $batdau, $limit";
$stmt1 = $conn->prepare($sql1);
$stmt1->execute();
$stmt1->setFetchMode(PDO::FETCH_ASSOC);
$result1 = $stmt1->fetchAll();

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>So trang</title>
	<style>
		ul li {
			float: left;
			margin-left: 15px;
			list-style-type: none;
		}
	</style>
</head>
<body>
	<table>
		<tr>
		<th>id</th>
		<th>name</th>
		</tr>

		<?php foreach ($result1 as $key => $value) { ?>
			<tr>
				<td><?php echo $value['id']; ?></td>
				<td><?php echo $value['name']; ?></td>
			</tr>
		<?php } ?>
	</table>
	<ul>
		<?php if ($tranghientai >1) { ?>
				<li>
				<a href="ppp.php?trang=<?php echo $prev ?>">Prev</a>
			</li>
			<?php } ?>
			
		
		
	<?php for ($i=1; $i <= $tongsotrang  ; $i++) { ?>
			
			<li>
				<a href="ppp.php?trang=<?php echo $i; ?> "> <?php echo $i; ?></a>
			</li>
	<?php } ?>


		<?php if ($tranghientai < $tongsotrang) { ?>
			<li><a href="ppp.php?trang=<?php echo $next ?>">Next</a></li>
		<?php } ?>
		
	</ul>
</body>
</html>