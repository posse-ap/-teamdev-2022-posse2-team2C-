<?php session_start();

$cart = $_SESSION["cart"];
$quantity = $_SESSION["quantity"];
$max = count($cart);

$dsn = "mysql:host=db;dbname=shukatu;charset=utf8";
$user = "root";
$password = "password";
$dbh = new PDO($dsn, $user, $password);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>個人情報入力ページ</title>
    <link rel="stylesheet" href="../style/sass/base/reset.css">
    <link rel="stylesheet" href="../style/css/userPage.css">
    <!-- ファビコン -->
    <link rel="icon" href="../style/img/favicon.ico" id="favicon">
    <script src="../js/form.js" defer></script>
</head>

<body>

    <?php include "../common/user_page_header.html"; ?>

    <section class="user_multiple-form">
        <div class="form-step">
            <ol class="c-stepper">
                <li class="c-stepper__item c-stepper__item_here">
                    <h3 class="c-stepper__title">情報の入力</h3>
                </li>
                <li class="c-stepper__item">
                    <h3 class="c-stepper__title">内容確認</h3>
                </li>
                <li class="c-stepper__item">
                    <h3 class="c-stepper__title">申請完了</h3>
                </li>
            </ol>
        </div>

        <form action="../student_info/multiple_apply_student_info_db_check.php" method="post" class="student_info__form">
            <span class="student_info__form_warning">※は必須です</span>

            <?php
            foreach ($cart as $key => $val) {

                $sql = "SELECT * FROM agent WHERE agent_id=?";
                $stmt = $dbh->prepare($sql);
                $data[0] = $val;
                $stmt->execute($data);

                $rec = $stmt->fetch(PDO::FETCH_ASSOC);

                $agent_id[] = $rec["agent_id"];
            ?>
                <!-- 後でtypeはhiddenに -->
                <!-- エージェントid -->
                <input type="hidden" name="agent_id_<?php echo $rec['agent_id']; ?>" value="<?php echo $rec['agent_id']; ?>">
            <?php
            }
            ?>

            <div>
                <span class="student_info__form_tittle"><span class="required">※</span>お名前</span>
                <span class="student_info__form_input_area">
                    <input type="text" name="student_family_name">
                    <input type="text" name="student_first_name">
                </span>
            </div>
            <div>
                <span class="student_info__form_tittle"><span class="required">※</span>ふりがな</span>
                <span class="student_info__form_input_area">
                    <input type="text" name="student_family_name_ruby">
                    <input type="text" name="student_first_name_ruby">
                </span>
            </div>
            <div>
                <span class="student_info__form_tittle"><span class="required">※</span>メール</span>
                <span class="student_info__form_input_area">
                    <input type="text" name="email_address">
                </span>
            </div>
            <div>
                <span class="student_info__form_tittle"><span class="required">※</span>電話番号</span>
                <span class="student_info__form_input_area">
                    <input type="text" name="phone_number">
                </span>
            </div>
            <div>
                <span class="student_info__form_tittle"><span class="required">※</span>大学名</span>
                <span class="student_info__form_input_area">
                    <input type="text" name="name_of_the_univ">
                </span>
            </div>
            <div>
                <span class="student_info__form_tittle"><span class="required">※</span>学部</span>
                <span class="student_info__form_input_area">
                    <input type="text" name="faculty">
                </span>
            </div>
            <div>
                <span class="student_info__form_tittle"><span class="required">※</span>学科</span>
                <span class="student_info__form_input_area">
                    <input type="text" name="department">
                </span>
            </div>
            <div>
                <span class="student_info__form_tittle"><span class="required">※</span>学年</span>
                <span class="student_info__form_input_area">
                    <input type="text" name="school_year">
                </span>
            </div>
            <div>
                <span class="student_info__form_tittle"><span class="required">※</span>卒年</span>
                <span class="student_info__form_input_area">
                    <input type="text" name="the_year_of_grad">
                </span>
            </div>
            <div>
                <span class="student_info__form_tittle">
                    <span class="required">※</span>
                    個人情報の取り扱い</span>
                <span class="student_info__form_input_area agree">
                    <div class="student_info__form_agree_text">
                        <p>
                            boozer（以下「当社」といいます）は、個人情報の取扱いに関する社内規程を定め、当社個人情報の取扱いの総責任者となる個人情報保護管理者のもと各部門個人情報管理者を選任し、個人情報の管理体制を整備しています。当社がお客さま、お取引先やパートナー企業さま等（以下「お客さま等」といいます）からお預かりする個人情報、匿名加工情報（以下「個人情報等」）は次のものです。<br>
                            当社は、匿名加工情報の適正な取扱いを確保するため、個人情報と同様の安全管理措置、個人情報の開示、訂正、削除等の処理などの措置を講じております。
                        </p>
                    </div>
                    <span class="student_info__form_agree_checkbox">
                        <label for="agree">同意する</label>
                        <input type="checkbox" id="agree" value="同意する">
                    </span>
                </span>
            </div>
            <span class="student_info__form_btn">
                <input type="button" onclick="history.back()" value="戻る" class="student_info__form_btn_back">
                <input type="submit" value="OK" class="student_info__form_btn_ok untouchable">
            </span>
        </form>
    </section>
    <footer>
        <img src="./img/boozer_logo.png" alt="" id="boozer_logo">
    </footer>

</body>

</html>