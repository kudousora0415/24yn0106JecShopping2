<?php
require_once './helpers/GoodsDAO.php';
$goods = false;
if (isset($_GET['goodscode'])) {
    $goodscode = $_GET['goodscode'];
    $goodsDAO = new GoodsDAO();
    $goods = $goodsDAO->get_goods_by_goodscode($goodscode);
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>商品詳細</title>
</head>
<body>
<?php include 'header.php' ?>
<?php if ($goods): ?>
    <table>
        <tr>
            <td rowspan="5">
                <img src="./images/goods/<?= $goods->goodsimage ?>" alt="<?= $goods->goodsname ?>">
            </td>
            <td><?= $goods->goodsname ?></td>
        </tr>
        <tr>
            <td><?= nl2br($goods->detail) ?></td>
        </tr>
        <tr>
            <td>¥<?= number_format($goods->price) ?></td>
        </tr>
        <tr>
            <td><?= $goods->recommend ? 'おすすめ' : '' ?></td>
        </tr>
        <tr>
    <td>
        <form action="cart.php" method="post">
            個数：
            <select name="num">
                <?php for ($i = 1; $i <= 10; $i++) : ?>
                    <option value="<?= $i ?>"><?= $i ?></option>
                <?php endfor; ?>
            </select>
            <input type="hidden" name="goodscode" value="<?= $goods->goodscode ?>">
            <input type="submit" name="add" value="カートに入れる">
        </form>
    </td>
</tr>
    </table>
<?php endif; ?>
</body>
</html>