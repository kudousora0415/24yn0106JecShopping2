<?php
require_once './helpers/GoodsGroupDAO.php';
require_once './helpers/GoodsDAO.php';

// 商品分類一覧取得
$goodsGroupDAO = new GoodsGroupDAO();
$goodsgroup_list = $goodsGroupDAO->get_goodsgroup();

$goodsDAO = new GoodsDAO();

// 商品分類が選択されたとき
if (isset($_GET['groupcode'])) {
    $groupcode = $_GET['groupcode'];
    $goods_list = $goodsDAO->get_goods_by_groupcode($groupcode);
} else {
    // おすすめ商品を取得
    $goods_list = $goodsDAO->get_recommend_goods();
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>JecShopping</title>
</head>
<body>

<?php include 'header.php'; ?>

<!-- 商品カテゴリ -->
<table>
  <?php foreach($goodsgroup_list as $goodsgroup) : ?> 
    <tr> 
      <td>
        <a href="index.php?groupcode=<?= $goodsgroup->groupcode ?>">
          <?= $goodsgroup->groupname ?>
        </a>
      </td> 
    </tr> 
  <?php endforeach; ?> 
</table>
<!-- 商品一覧 -->
<?php foreach($goods_list as $goods) : ?>
    <table align="left" style="margin-bottom:30px">
    <tr>
      <td>
      <a href="goods.php?goodscode=<?= $goods->goodscode ?>">
        <img src="./images/goods/<?= $goods->goodsimage ?>" >
      </td>
    </tr>
    <tr>
      <td>
        <a href="goods.php?goodscode=<?= $goods->goodscode ?>">
          <?= $goods->goodsname ?>
        </a>
      </td>
    </tr>
    <tr>
      <td>¥<?= number_format($goods->price) ?></td>
    </tr>
    <tr>
      <td><?= $goods->recommend ? "おすすめ" : "" ?></td>
    </tr>
  </table>
<?php endforeach; ?>

</body>
</html>