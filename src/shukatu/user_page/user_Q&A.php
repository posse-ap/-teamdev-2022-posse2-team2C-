<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../style/sass/base/reset.css">
    <link rel="stylesheet" href="../style/css/userPage.css">
    <link rel="icon" href="../style/img/favicon.ico" id="favicon">
  <script src="../js/header.js" defer></script>
  <script src="../js/user_Q&A.js" defer></script>
  <title>Q&A・お問合せページ</title>
</head>

<body>
  <?php include "../common/user_page_header.html" ?>
  <section id="Q-A">
    <h1 id="Q-A_title">Q&A</h1>
    <div id="Q-A_area">

      <div class="pare_of_Q-A">
        <div class="question">
          <span class="Q"><p>Q</p></span>
          <div class="question_textarea">
            <p>question1</p>
          </div>
          <span class="show_ans_wrapper"><span class="show_ans" id="show_ans_1"></span></span>
        </div>
        <div class="answer" id="answer_1">
          <span class="A">A</span>
          <div class="ans_textarea">
            <p>answer1</p>
          </div>
        </div>
      </div>

      <div class="pare_of_Q-A">
        <div class="question">
          <span class="Q"><p>Q</p></span>
          <div class="question_textarea">
            <p>question2</p>
          </div>
          <span class="show_ans_wrapper"><span class="show_ans" id="show_ans_2"></span></span>
        </div>
        <div class="answer" id="answer_2">
          <span class="A">A</span>
          <div class="ans_textarea">
            <p>answer2</p>
          </div>
        </div>
      </div>

      <div class="pare_of_Q-A">
        <div class="question">
          <span class="Q"><p>Q</p></span>
          <div class="question_textarea">
            <p>question3</p>
          </div>
          <span class="show_ans_wrapper"><span class="show_ans" id="show_ans_3"></span></span>
        </div>
        <div class="answer" id="answer_3">
          <span class="A">A</span>
          <div class="ans_textarea">
            <p>answer3</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="user-contact">
    

  </section>
</body>

</html>