<?php
require_once 'DAO.php';

class Member {
    public int $memberid;      // 会員ID
    public string $email;      // メールアドレス
    public string $membername; // 会員名
    public string $zipcode;    // 郵便番号
    public string $address;    // 住所
    public string $tel;        // 電話番号
    public string $password;   // パスワード
}

class MemberDAO {
    public function get_member(string $email, string $password) {
        $dbh = DAO::get_db_connect();
        $sql = "SELECT * FROM Member WHERE email = :email";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $member = $stmt->fetchObject('Member');
        if ($member !== false) {
            if (password_verify($password, $member->password)) {
                return $member;
            }
        }
        return false;
    }
}