<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../style/sass/base/reset.css">
  <link rel="stylesheet" href="../style/css/userPage.css">
  <!-- ファビコン -->
  <link rel="icon" href="../style/img/favicon.ico" id="favicon">
  <script src="../js/header.js" defer></script>
  <title>使い方ガイドページ</title>
</head>

<body>
  <?php include "../common/user_page_header.html" ?>
  <section class="user_howToUse">
    <h1 class="head_howToUse">CRAFT利用簡単2ステップ!</h1>
    <div class="user_flow">
      <div id="step1" class="steps">
        <h2 class="head_flow">step1 絞り込み</h2>
        <div class="text_flow">・タグを使って自分にぴったりのエージェントを探す</div>

        <div class="user_flow__small-step">
          <p class="user_flow__small-step_text"><span class="user_flow__btn">タグから探す</span> ボタンを押してタグを選択</p>
          <img src="./img/user-flow/user-flow_tag.png" class="user_flow__img_tag">
        </div>

        <div class="text_flow">・自分の住んでいるエリアで面談可能なエージェントを探す
        </div>
        <div class="user_flow__small-step">
          <p class="user_flow__small-step_text"><span class="user_flow__btn">エリアから探す</span> ボタンを押してエリアを選択</p>
          <img src="./img/user-flow/user-flow_area-1.png" class="user_flow__img_area">
          <img src="./img/user-flow/user-flow_area-2.png" class="user_flow__img_area">
        </div>

        <div class="text_flow">・選んだタグ、エリアで絞り込み</div>
        <div class="user_flow__small-step">
          <p class="user_flow__small-step_text"><span class="user_flow__btn-search">絞り込む<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24">
                <path d="M23.832 19.641l-6.821-6.821c2.834-5.878-1.45-12.82-8.065-12.82-4.932 0-8.946 4.014-8.946 8.947 0 6.508 6.739 10.798 12.601 8.166l6.879 6.879c1.957.164 4.52-2.326 4.352-4.351zm-14.886-4.721c-3.293 0-5.973-2.68-5.973-5.973s2.68-5.973 5.973-5.973c3.294 0 5.974 2.68 5.974 5.973s-2.68 5.973-5.974 5.973z" />
              </svg></span> ボタンを押して絞り込む</p>
        </div>

      </div>

      <div id="step2" class="steps">
        <h2 class="head_flow">step2 申請</h2>
        <div class="text_flow">・気になるエージェントの画像をクリックorタップ → <span class="user_flow__btn_go-form">申請に進む</span> ボタンを押す</div>
        <div class="user_flow__small-step">
          <img src="./img/user-flow/user-flow_agent.png" class="user_flow__img">
        </div>

        <div class="text_flow">・必要な情報を入力して、申請する</div>
        <div class="user_flow__small-step">
          <img src="./img/user-flow/user-flow_form.png" class="user_flow__img form">
        </div>
      </div>
    </div>

    <h1 class="head_howToUse">まとめて申請もできる！</h1>
    <div class="user_flow">
      <div class="steps">
        <div class="text_flow">一覧画面やエージェント詳細ページの❤️からお気に入り登録 → お気に入り一覧から一括申請！</div>
        <img src="./img/user-flow/user-flow_cart.png" alt="" class="user_flow__img cart">
      </div>
    </div>
  </section>

  <footer>
    <img src="./img/boozer_logo.png" alt="" id="boozer_logo">
  </footer>
  <script src="../js/header.js"></script>
</body>

</html>