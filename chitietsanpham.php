<?php
$rowSP = $sp->rowSanPham($_GET['idSP']);
?>
<div class="col-md-12">
    <div>
        <ol class="breadcrumb">
            <li><a href="<?php echo $sp->hrefdanhsachsanpham('dsSP', '', $_GET['hang'], $_GET['sx'], $_GET['page'], $_GET['key']); ?>">Trang chủ</a></li>
            <li class="active">Chi tiết sản phẩm</li>
            <?php
            if (isset($_GET['idSP'])) {
                echo '<li class="active">' . $rowSP['name_product'] . '</li>';
            }
            ?>

        </ol>
    </div>
</div>
<h1>&nbsp;</h1><br>
<div class="row">
    <div class="col-md-4 text-center col-sm-12 col-xs-12">
        <div class="">
            <?php if ($rowSP['sale_product'] >= $rowSP['price_product']): ?>
                <span class="offer-text fa fa-bitcoin" style="padding: 5px 10px; border-radius: 3px;"> <?php echo $rowSP['price_product']; ?> K</span>
            <?php else: ?>
                <span  class="offer-text2 fa fa-tags" style="padding: 5px 10px; border-radius: 3px;"> <?php echo $rowSP['sale_product']; ?> K</span>
            <?php endif; ?>
            <img src="public/images/<?php echo $sp->row_img($rowSP['image_product'])['url_image']; ?>" alt="<?php echo $rowSP['name_product']; ?>" class="img-responsive"/>
        </div>
    </div>
    <div class="col-md-8 col-sm-12 col-xs-12">
        <div class="">
            <h3><strong>Thông tin sản phẩm:</strong></h3>
            <div class="caption">
                <h3>
                    <a href="?ac=ctSP&idSP=<?php echo $rowSP['id_product']; ?>">
                        <?php echo $rowSP['name_product']; ?> 
                    </a>
                </h3>
                <?php
                $loaiSP = $sp->rowLoaiSP($rowSP['id_type']);
                ?>
                <p>Loại : <strong><?php echo $sp->rowLoaiSP($loaiSP['id_type'])['name_type']; ?> </strong>  </p>
                <?php
                $hangSX = $sp->rowNSX($rowSP['id_brand']);
                ?>
                <p>Hãng : <strong><?php echo $sp->rowNSX($hangSX['id_brand'])['name_brand'];
                ?> </strong>  </p>
                <?php if ($rowSP['price_product'] == $rowSP['sale_product']): ?>
                    <p>Giá : <strong><?php echo $rowSP['price_product']; ?> K</strong>  </p>
                <?php else: ?>
                    <p style="color: red;">Chỉ còn : <strong><?php echo $rowSP['sale_product']; ?> K</strong>  </p>
                <?php endif; ?>
                <p><?php echo $rowSP['info_product']; ?></p>
                <a href="addCart.php?sl=1&idSP=<?php
                if (isset($_GET['idSP'])) {
                    echo $_GET['idSP'];
                }
                ?>" class="btn btn-success" role="button">Thêm vào giỏ</a>
            </div>
        </div>
    </div>
</div>
<h1>&nbsp;</h1><br>
<h1>INSERT DATA TO DATABASE</h1>
<h2> Enter Data to Database</h2>
<?php 

echo "Insert database!";
?>
<ul>
	<form name="Insert Data" action="InsertData.php" method= "POST">
		<li>PCID:</li><li><input type="text" name="PCID"/></li>
		<li>PC Name:</li><li><input type="text" name="PcName"></li>
		<li><input type="submit" /></li>
	</form>
</ul>
<?php

if (empty(getenv("DATABASE_URL"))){
echo '<p> The DB does not exist </p>';
$pdo = new PDD ('pgsql:host=localhost;port=5432;dbname=mydb', 'postgres', '123456');

}
else {
	$db = parse_url(gentenv("DATABASE_URL"));
	$pdo = new PDD ("pgsql:" . sprintf(
		"host=ec2-54-255-72-238.compute-1.amazonaws.com;port=5432;user=zyspzjqbrlxfnk;password=95402f2fc; dbname=d7f8iof0djq8lo",
		$db["host"],
		$db["port"],
		$db["user"],
		$db["pass"],
		ltrim($db["path"], "/")
	));
}
if ($pdo === false) {
	echo "ERROR: Could not connect DataBase";
}
$sql = "INSERT INTO pc(PcId, PcName)"
	.VALUE('$_POST[PCID]', '$_POST[PcName]')";
$stmt = $pdo->prepare($sql);
#$stmt_>execute();
if (is_null($_POST[pcid])) {
    echo: "PC not be not null";
 } 
else 
{
if ($stmt ->execute() ==TRUE) {
                echo "Record insert successfully"
}
else {
                echo "Error inserting record"
 }
 }
