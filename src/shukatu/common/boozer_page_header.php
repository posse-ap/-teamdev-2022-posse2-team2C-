<header class="boozer-page__header">
    <span class="boozer-page__header_craft-logo">CRAFT</span>
    <span class="boozer-page__header_for-boozer">for boozer</span>
    <span class="boozer-page__header_staff-_name"><?php print $_SESSION["name"];?>様ログイン中</span>
</header>

<div class="boozer-page__container">
        <div class="boozer-page__side-menu">
            <ul class="boozer-page__side-menu_wrapper">
                <li class="boozer-page__side-menu_li"><a href="../boozer_login/boozer_login_top.php" class="boozer-page__side-menu_text">ホーム</a></li>
                <li class="boozer-page__side-menu_li"><a href="../agent_info/agent_list.php" class="boozer-page__side-menu_text">エージェント一覧</a></li>
                <li class="boozer-page__side-menu_li"><a href="../agent_info/agent_add.php" class="boozer-page__side-menu_text">新規エージェント作成</a></li>
                <li class="boozer-page__side-menu_li"><a href="../boozer_page/boozer_page_student_list.php" class="boozer-page__side-menu_text">学生情報一覧</a></li>
                <li class="boozer-page__side-menu_li"><a href="../boozer_page/boozer_staff_list.php" class="boozer-page__side-menu_text">boozerスタッフ管理</a></li>
                <li class="boozer-page__side-menu_li"><a href="../boozer_login/boozer_logout.php" class="boozer-page__side-menu_text">ログアウト</a></li>
            </ul>
        </div>