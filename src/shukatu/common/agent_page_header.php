<header class="agent-page__header">
    <span class="agent-page__header_craft-logo">CRAFT</span>
    <span class="agent-page__header_for-boozer">for agent</span>
    <span class="agent-page__header_staff-_name"><?php print $_SESSION["company_name"]; ?>様ログイン中</span>
</header>

<div class="agent-page__container">
    <div class="agent-page__side-menu">
        <ul class="agent-page__side-menu_wrapper">
            <li class="agent-page__side-menu_li"><a href="../agent_login/agent_login_top.php" class="agent-page__side-menu_text">ホーム</a></li>
            <li class="agent-page__side-menu_li"><a href="../agent_page/agent_page_student_list.php?agent_id=<?php print $_SESSION["agent_id"];?>" class="agent-page__side-menu_text">学生情報一覧</a></li>
            <li class="agent-page__side-menu_li"><a href="../agent_page/agent_info_edit_request.php?agent_id=<?php print $_SESSION["agent_id"];?>" class="agent-page__side-menu_text">掲載情報編集</a></li>
            <li class="agent-page__side-menu_li"><a href="../agent_login/agent_logout.php" class="agent-page__side-menu_text">ログアウト</a></li>
        </ul>
    </div>