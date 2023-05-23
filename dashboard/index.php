<?php
$file = json_decode(file_get_contents("../today.json"))->today->articles;
include "../inc/head.php";
session_start();
include "inc/navbar.php";



?>


<div class="p-4 sm:ml-64">
  <div class="border-2 border-gray-200 border-dashed rounded-lg mt-14">
    <div class="grid place-items-center mr-6 ml-6">
      <div class="mx-auto my-6 grid gap-4 max-w-6xl place-items-center">

        <a href="input.php"
          class="flex items-center justify-center h-44 w-full rounded bg-gray-100 rounded-lg hover:bg-gray-300">
          <p class="text-2xl text-gray-400">+</p>
        </a>

        <?php
        foreach ($file as $article) {
          $title = $article->title;
          $image = $article->image;
          $desc = $article->description;
          ?>
          <a href=""
            class="flex items-center bg-white border border-gray-200 rounded-lg shadow flex-row max-w-xl hover:bg-gray-100">
            <img class="hidden md:flex w-48 h-full aspect-square object-cover rounded-none rounded-l-lg"
              src="<?= $image ?>" alt="">
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



<?php
include "../inc/foot.php";
?>