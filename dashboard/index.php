<?php
// $file = json_decode(file_get_contents("../today.json"))->today->articles;
include "../inc/conn.php";

session_start();
if (!isset($_SESSION['username']))
  header("location:../index.php");
include "../inc/head.php";
$userid = $_SESSION['userid'];
include "inc/navbar.php";

$file = $conn->query("select * from news inner join publish on news.id = publish.news_id where publish.user_id = $userid order by publish.date desc");


?>


<div class="p-4 sm:ml-64">
  <div class="border-2 border-gray-200 border-dashed rounded-lg mt-14">
    <div class="grid place-items-center mr-6 ml-6">
      <div class="w-full mx-auto my-6 grid gap-4 max-w-6xl place-items-center">

        <a href="input.php"
          class="flex items-center justify-center h-44 w-full md:max-w-xl rounded bg-gray-100 rounded-lg hover:bg-gray-300">
          <p class="text-2xl text-gray-400">+</p>
        </a>

        <?php
        while ($article = $file->fetch_object()) {
          $title = $article->title;
          $image = $article->image;
          $desc = $article->content;
          ?>
          <a href=""
            class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100">
            <?php if (!empty($image)) { ?>
              <img class="md:w-48 h-full md:aspect-square object-cover rounded-t-lg md:rounded-none md:rounded-l-lg"
                src="<?= $image ?>" alt="">
            <?php } ?>
            <div class="flex flex-col justify-between p-4 leading-normal overflow-hidden">
              <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 line-clamp-2">
                <?= $title ?>
              </h5>
              <p class="mb-3 font-normal text-gray-700 line-clamp-3">
                <?= $desc ?>
              </p>
            </div>
          </a>
          <?php
        }
        ?>

      </div>
    </div>
  </div>
</div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
</body>

</html>