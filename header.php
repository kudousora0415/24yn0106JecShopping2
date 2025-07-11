<?php
require_once './helpers/MemberDAO.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$total = 0;
if (!empty($_SESSION['member'])) {
    $member = $_SESSION['member'];
    require_once './helpers/CartDAO.php';
    $cartDAO = new CartDAO();
    $cart_list = $cartDAO->get_cart_by_memberid($member->memberid);
    foreach ($cart_list as $cart) {
      $total += $cart->num;
    }
}
?>
<header>
  <div>
    <a href="index.php">
      <img src="images/JecShoppingLogo.svg" alt="JecShoppingロゴ">
    </a>
  </div>
  <div>
    <?php if (isset($member)) : ?>
        <?= $member->membername ?>さん
        <a href="cart.php">カート(<?= $total ?>)</a>
        <a href="logout.php">ログアウト</a>
    <?php else: ?>
        <a href="login.php">ログイン</a>
    <?php endif; ?>
  </div>
  <hr>
</header>