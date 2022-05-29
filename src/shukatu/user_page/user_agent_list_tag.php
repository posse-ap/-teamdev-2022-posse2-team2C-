<?php
//ログインチェック 別にログインしてなくてもみれる
session_start();
session_regenerate_id(true);
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>就活エージェント比較サイトタグ検索後ページ</title>
    <!-- cssファイル -->
    <link rel="stylesheet" href="../style/sass/base/reset.css">
    <link rel="stylesheet" href="../style/css/userPage.css">
    <link rel="stylesheet" href="../style/sass/parts/favorite_heart.css">
    <!-- ファビコン -->
    <link rel="icon" href="../style/img/favicon.ico" id="favicon">
    <!-- js -->
    <script src="../js/user_page.js" defer></script>
    <script src="../js/user_top.js" defer></script>
    <script src="http://code.jquery.com/jquery.min.js"></script>
    <script src="../js/header.js" defer></script>
    <script src="../js/favorite.js" defer></script>
    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sawarabi+Gothic&family=Zen+Kaku+Gothic+New:wght@300&family=Zen+Maru+Gothic:wght@300&display=swap" rel="stylesheet">
</head>

<body>
    <section class="whole-wrapper">
        <div class="whole-wrapper__background"></div>
        <!-- header -->
        <?php include "../common/user_page_header.html";

        try {


            // require_once("../common/common.php");

            if (isset($_POST["1"]) === true) {
                $tag_1 = 1;
                // echo $tag_1;
            } else {
                $tag_1 = 0;
                // echo $tag_1;
            }

            if (isset($_POST["2"])) {

                $tag_2 = 1;
            } else {
                $tag_2 = 0;
                // echo $tag_1;
            }


            $dsn = "mysql:host=db;dbname=shukatu;charset=utf8";
            $user = "root";
            $password = "password";
            $dbh = new PDO($dsn, $user, $password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $arr1 = array();
            foreach ($_GET['tag'] as $tag) {
                $arr1[] = "tag_" . $tag . "=1";
            }
            $arr2 = array();
            foreach ($_GET['region'] as $region) {
                $arr2[] = "region" . $region . "=1";
            }
            $arr3 = array();
            foreach ($_GET['prefecture'] as $prefecture) {
                $arr3[] = "prefecture" . $prefecture . "=1";
            }
            $a = implode(" AND ", $arr1);
            $b = implode(" AND ", $arr2);
            $c = implode(" AND ", $arr3);
            $sql = "SELECT DISTINCT agent.agent_id, company_name, catchphrase FROM agent INNER JOIN tag_existence ON agent.agent_id = tag_existence.agent_id WHERE $a";
            $stmt = $dbh->prepare($sql);
            $stmt->execute();
            $dbh = null;
        ?>

            <!-- <div class="current-tag-area-search__wrapper">
                <div class="current-area">
                    <span class="current-area_tittle">
                        選択されているエリア
                    </span>
                    <?php
                    $tag_names = $_GET["tag"];
                    foreach ($tag_names as $tag_name) {
                        $show_tag = $tag_name;


                        $dsn = "mysql:host=db;dbname=shukatu;charset=utf8";
                        $user = "root";
                        $password = "password";
                        $dbh_2 = new PDO($dsn, $user, $password);
                        $dbh_2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $sql_2 = "SELECT tag_name FROM tag WHERE tag_code = $tag_name";
                        $stmt_2 = $dbh_2->prepare($sql_2);
                        $stmt_2->execute();
                        $dbh_2 = null;
                        while (true) {
                            $rec_2 = $stmt_2->fetch(PDO::FETCH_ASSOC);
                            if ($rec_2 === false) {
                                break;
                            } ?>
                            <div><?php echo $rec_2["tag_name"]; ?>
                            </div>
                    <?php
                        }
                    }
                    ?>
                </div>
                <div class="current-tag">
                    <span class="current-tag_tittle">
                    選択されているタグ
                    </span>
                    <?php
                    $tag_names = $_GET["tag"];
                    foreach ($tag_names as $tag_name) {
                        $show_tag = $tag_name;


                        $dsn = "mysql:host=db;dbname=shukatu;charset=utf8";
                        $user = "root";
                        $password = "password";
                        $dbh_2 = new PDO($dsn, $user, $password);
                        $dbh_2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $sql_2 = "SELECT tag_name FROM tag WHERE tag_code = $tag_name";
                        $stmt_2 = $dbh_2->prepare($sql_2);
                        $stmt_2->execute();
                        $dbh_2 = null;
                        while (true) {
                            $rec_2 = $stmt_2->fetch(PDO::FETCH_ASSOC);
                            if ($rec_2 === false) {
                                break;
                            } ?>
                            <div><?php echo $rec_2["tag_name"]; ?>
                            </div>
                    <?php
                        }
                    }
                    ?>
                </div>
                </div> -->
            <div class="tag-area-search__wrapper">
                <div class="tag-search">
                    <button class="tag-search__btn"><span class="tag-search__btn_text">タグから探す</span></button>
                </div>
                <div class="area-search">
                    <button class="area-search__btn"><span class="area-search__btn_text">エリアから探す</span></button>
                </div>
            </div>
            <div class="tag-area__wrapper">
                <div class="tag__background"></div>
                <form action="user_agent_list_tag.php" method="get" class="tag__form">
                    <div class="tag">
                        <span class="tag__tittle">タグ検索</span>
                        <div class="tag__input"><input type="checkbox" name="tag[]" value="1">文系</div>
                        <div class="tag__input"><input type="checkbox" name="tag[]" value="2">理系</div>
                        <div class="tag__input"><input type="checkbox" name="tag[]" value="3">オンライン面談可</div>
                        <div class="tag__input"><input type="checkbox" name="tag[]" value="4">23卒</div>
                        <div class="tag__input"><input type="checkbox" name="tag[]" value="5">24卒</div>
                        <div class="tag__input"><input type="checkbox" name="tag[]" value="6">25卒</div>
                        <div class="tag__input"><input type="checkbox" name="tag[]" value="7">大手</div>
                        <div class="tag__input"><input type="checkbox" name="tag[]" value="8">ベンチャー</div>
                        <div class="tag__input"><input type="checkbox" name="tag[]" value="9">広告・出版・マスコミ</div>
                        <div class="tag__input"><input type="checkbox" name="tag[]" value="10">金融</div>
                        <div class="tag__input"><input type="checkbox" name="tag[]" value="11">サービス・インフラ</div>
                        <div class="tag__input"><input type="checkbox" name="tag[]" value="12">小売</div>
                        <div class="tag__input"><input type="checkbox" name="tag[]" value="13">ソフトウェア</div>
                        <div class="tag__input"><input type="checkbox" name="tag[]" value="14">官公庁・校舎・団体</div>
                        <div class="tag__input"><input type="checkbox" name="tag[]" value="15">商社</div>
                        <div class="tag__determination-btn" onclick="hide_tag()">決定</div>
                    </div>
                    <div class="area__background"></div>
                    <div class="area">
                        <span class="area__tittle">エリア検索</span>
                        <div class="area__wrapper">
                            <div class="area__container">
                                <div class="area__region"><input type="checkbox" name="region[]" value="1">北海道</div>
                            </div>
                            <div class="area__container">
                                <div class="area__region"><input type="checkbox" name="region[]" value="2">東北</div>
                                <div class="area__prefecture"><input type="checkbox" name="prefecture[]" value="1">青森</div>
                                <div class="area__prefecture"><input type="checkbox" name="prefecture[]" value="2">秋田</div>
                                <div class="area__prefecture"><input type="checkbox" name="prefecture[]" value="3">岩手</div>
                                <div class="area__prefecture"><input type="checkbox" name="prefecture[]" value="4">山形</div>
                                <div class="area__prefecture"><input type="checkbox" name="prefecture[]" value="5">宮城</div>
                                <div class="area__prefecture"><input type="checkbox" name="prefecture[]" value="6">福島</div>
                            </div>
                            <div class="area__container">
                                <div class="area__region"><input type="checkbox" name="region[]" value="3">関東</div>
                                <div class="area__prefecture"><input type="checkbox" name="prefecture[]" value="1">東京</div>
                                <div class="area__prefecture"><input type="checkbox" name="prefecture[]" value="2">埼玉</div>
                                <div class="area__prefecture"><input type="checkbox" name="prefecture[]" value="3">群馬</div>
                                <div class="area__prefecture"><input type="checkbox" name="prefecture[]" value="4">栃木</div>
                                <div class="area__prefecture"><input type="checkbox" name="prefecture[]" value="5">茨城</div>
                                <div class="area__prefecture"><input type="checkbox" name="prefecture[]" value="6">千葉</div>
                                <div class="area__prefecture"><input type="checkbox" name="prefecture[]" value="7">神奈川</div>
                            </div>
                            <div class="area__container">
                                <div class="area__region"><input type="checkbox" name="region[]" value="4">中部</div>
                                <div class="area__prefecture"><input type="checkbox" name="prefecture[]" value="1">長野</div>
                                <div class="area__prefecture"><input type="checkbox" name="prefecture[]" value="2">山梨</div>
                                <div class="area__prefecture"><input type="checkbox" name="prefecture[]" value="3">新潟</div>
                                <div class="area__prefecture"><input type="checkbox" name="prefecture[]" value="4">岐阜</div>
                                <div class="area__prefecture"><input type="checkbox" name="prefecture[]" value="5">静岡</div>
                                <div class="area__prefecture"><input type="checkbox" name="prefecture[]" value="6">愛知</div>
                                <div class="area__prefecture"><input type="checkbox" name="prefecture[]" value="7">富山</div>
                                <div class="area__prefecture"><input type="checkbox" name="prefecture[]" value="8">石川</div>
                                <div class="area__prefecture"><input type="checkbox" name="prefecture[]" value="9">福井</div>
                            </div>
                            <div class="area__container">
                                <div class="area__region"><input type="checkbox" name="region[]" value="5">近畿</div>
                                <div class="area__prefecture"><input type="checkbox" name="prefecture[]" value="1">三重</div>
                                <div class="area__prefecture"><input type="checkbox" name="prefecture[]" value="2">滋賀</div>
                                <div class="area__prefecture"><input type="checkbox" name="prefecture[]" value="3">京都</div>
                                <div class="area__prefecture"><input type="checkbox" name="prefecture[]" value="4">兵庫</div>
                                <div class="area__prefecture"><input type="checkbox" name="prefecture[]" value="5">大阪</div>
                                <div class="area__prefecture"><input type="checkbox" name="prefecture[]" value="6">和歌山</div>
                                <div class="area__prefecture"><input type="checkbox" name="prefecture[]" value="7">奈良</div>
                            </div>
                            <div class="area__container">
                                <div class="area__region"><input type="checkbox" name="region[]" value="6">中国</div>
                                <div class="area__prefecture"><input type="checkbox" name="prefecture[]" value="1">岡山</div>
                                <div class="area__prefecture"><input type="checkbox" name="prefecture[]" value="2">広島</div>
                                <div class="area__prefecture"><input type="checkbox" name="prefecture[]" value="3">鳥取</div>
                                <div class="area__prefecture"><input type="checkbox" name="prefecture[]" value="4">島根</div>
                                <div class="area__prefecture"><input type="checkbox" name="prefecture[]" value="5">山口</div>
                            </div>
                            <div class="area__container">
                                <div class="area__region"><input type="checkbox" name="region[]" value="7">四国</div>
                                <div class="area__prefecture"><input type="checkbox" name="prefecture[]" value="1">香川</div>
                                <div class="area__prefecture"><input type="checkbox" name="prefecture[]" value="2">高知</div>
                                <div class="area__prefecture"><input type="checkbox" name="prefecture[]" value="3">徳島</div>
                                <div class="area__prefecture"><input type="checkbox" name="prefecture[]" value="4">愛媛</div>
                            </div>
                            <div class="area__container">
                                <div class="area__region"><input type="checkbox" name="region[]" value="8">九州</div>
                                <div class="area__prefecture"><input type="checkbox" name="prefecture[]" value="1">福岡</div>
                                <div class="area__prefecture"><input type="checkbox" name="prefecture[]" value="2">大分</div>
                                <div class="area__prefecture"><input type="checkbox" name="prefecture[]" value="3">宮崎</div>
                                <div class="area__prefecture"><input type="checkbox" name="prefecture[]" value="4">鹿児島</div>
                                <div class="area__prefecture"><input type="checkbox" name="prefecture[]" value="5">熊本</div>
                                <div class="area__prefecture"><input type="checkbox" name="prefecture[]" value="6">佐賀</div>
                                <div class="area__prefecture"><input type="checkbox" name="prefecture[]" value="7">長崎</div>
                                <div class="area__prefecture"><input type="checkbox" name="prefecture[]" value="8">沖縄</div>
                            </div>
                        </div>
                        <div class="area__btn-area"></div>
                    </div>
                    <div class="both-search">
                        <button class="both-search__btn">
                            <span class="both-search__btn_text">検索する
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                    <path d="M23.832 19.641l-6.821-6.821c2.834-5.878-1.45-12.82-8.065-12.82-4.932 0-8.946 4.014-8.946 8.947 0 6.508 6.739 10.798 12.601 8.166l6.879 6.879c1.957.164 4.52-2.326 4.352-4.351zm-14.886-4.721c-3.293 0-5.973-2.68-5.973-5.973s2.68-5.973 5.973-5.973c3.294 0 5.974 2.68 5.974 5.973s-2.68 5.973-5.974 5.973z" />
                                </svg>
                            </span>
                        </button>
                    </div>
                </form>
            </div>

            <div class="top-page__main_contents">
                <div class="current-tag-area-search__wrapper">
                    <div class="current-area">
                        <span class="current-area_tittle">
                            エリア
                        </span>
                        <div class="current-area__areas_box">
                            <?php
                            $tag_names = $_GET["tag"];
                            foreach ($tag_names as $tag_name) {
                                $show_tag = $tag_name;


                                $dsn = "mysql:host=db;dbname=shukatu;charset=utf8";
                                $user = "root";
                                $password = "password";
                                $dbh_2 = new PDO($dsn, $user, $password);
                                $dbh_2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                $sql_2 = "SELECT tag_name FROM tag WHERE tag_code = $tag_name";
                                $stmt_2 = $dbh_2->prepare($sql_2);
                                $stmt_2->execute();
                                $dbh_2 = null;
                                while (true) {
                                    $rec_2 = $stmt_2->fetch(PDO::FETCH_ASSOC);
                                    if ($rec_2 === false) {
                                        break;
                                    } ?>
                                    <div class="current-area__areas"><?php echo $rec_2["tag_name"]; ?>
                                    </div>
                            <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <div class="current-tag">
                        <span class="current-tag_tittle">
                            タグ
                        </span>
                        <div class="current-tag__tags_box">
                            <?php
                            $tag_names = $_GET["tag"];
                            foreach ($tag_names as $tag_name) {
                                $show_tag = $tag_name;


                                $dsn = "mysql:host=db;dbname=shukatu;charset=utf8";
                                $user = "root";
                                $password = "password";
                                $dbh_2 = new PDO($dsn, $user, $password);
                                $dbh_2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                $sql_2 = "SELECT tag_name FROM tag WHERE tag_code = $tag_name";
                                $stmt_2 = $dbh_2->prepare($sql_2);
                                $stmt_2->execute();
                                $dbh_2 = null;
                                while (true) {
                                    $rec_2 = $stmt_2->fetch(PDO::FETCH_ASSOC);
                                    if ($rec_2 === false) {
                                        break;
                                    } ?>
                                    <div class="current-tag__tags"><?php echo $rec_2["tag_name"]; ?>
                                    </div>
                            <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="top-page__agent_position top-page__agent_position_tag">

                    <?php
                    while (true) {
                        $rec = $stmt->fetch(PDO::FETCH_ASSOC);
                        if ($rec === false) {
                            break;
                        }
                        $agent_id = $rec["agent_id"];
                    ?>
                        <div class="top-page__agent">
                            <div class="top-page__agent_wrapper">
                                <div class="top-page__agent_img-wrapper">
                                    <div class="top-page__agent_heart">
                                        <?php
                                        $cart = $_SESSION["cart"];
                                        if (in_array($agent_id, $cart) === true) { ?>
                                            <div class="likes">
                                                <div class="LikedIcon">
                                                    <img src="../style/img/liked.png" width="150%">
                                                </div>
                                            </div>

                                        <?php };
                                        if (in_array($agent_id, $cart) === false) { ?>
                                            <a href="user_cartin.php?agent_id=<?php echo $agent_id; ?>" class="heart_link">
                                                <div class="Likes">
                                                    <div class="LikesIcon"></div>
                                                </div>
                                            </a>
                                        <?php }; ?>
                                    </div>
                                    <a href='user_detail.php?agent_id=<?php echo $agent_id; ?>' class="top-page__agent_detail-btn">
                                        <img src="./agent_img/agent_img_<?php echo $agent_id; ?>.png" alt="" class="top-page__agent_img">
                                    </a>
                                    <!-- <div class="top-page__agent_tag"><span class="top-page__agent_tag_text">#</span></div> -->
                                </div>
                            </div>
                            <div class="top-page__agent_text">
                                <span class="top-page__agent_text_company-name"><?php print $rec["company_name"]; ?></span>
                                <span class="top-page__agent_text_catchphrase"><?php print $rec["catchphrase"]; ?></span>
                            </div>
                        </div>

                <?php }
                } catch (Exception $e) {
                    print "只今障害が発生しております。<br><br>";
                    echo "（　´∀｀）つ□ 涙拭けよ: " . $e->getMessage() . "\n";
                    print "<a href='../boozer_login/boozer_login.php'>ログイン画面へ</a>";
                }
                ?>
                </div>
                <div class="top_page__search_area_pc">
                    <div class="tag-search">
                        <button class="tag-search__btn"><span class="tag-search__btn_text">タグから探す</span></button>
                    </div>
                    <div class="area-search">
                        <button class="area-search__btn"><span class="area-search__btn_text">エリアから探す</span></button>
                    </div>
                </div>
            </div>
            <div class="search_box_switcher">
                <div>
                    絞り込み
                </div>
            </div>
            <footer>
                <img src="./img/boozer_logo.png" alt="" id="boozer_logo">
            </footer>
    </section>
</body>

</html>