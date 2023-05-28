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

        <a href="input.php" class="flex items-center justify-center h-44 w-full md:max-w-xl bg-gray-100 rounded-lg hover:bg-gray-300">
          <p class="text-2xl text-gray-400">+</p>
        </a>

        <?php
        while ($article = $file->fetch_object()) {
          $id = $article->id;
          $title = $article->title;
          $image = $article->image;
          $desc = $article->content;
        ?>
          <div class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 cursor-pointer">
            <?php if (!empty($image)) { ?>
              <img class="md:w-48 h-full md:aspect-square object-cover rounded-t-lg md:rounded-none md:rounded-l-lg" src="<?= $image ?>" alt="">
            <?php } ?>
            <div class="flex flex-col justify-between p-4 leading-normal overflow-hidden">
              <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 line-clamp-2">
                <?= $title ?>
              </h5>
              <p class="mb-3 font-normal text-gray-700 line-clamp-3">
                <?= $desc ?>
              </p>
            </div>
            <div class="h-full p-4">
              <ul class="py-2 text-sm text-gray-700">
                <li class="">
                  <form action="update.php" method="post">
                    <input type="hidden" name="newsid" value="<?= $article->id
                                                              ?>">
                    <button type="submit" class="block px-4 py-2 hover:bg-gray-200" name="update">
                      Update
                    </button>
                  </form>
                </li>
                <li>
                  <form method="post">
                    <input type="hidden" name="newsid" value="<?= $article->id
                                                              ?>">
                    <button type="submit" class="block px-4 py-2 hover:bg-gray-200" name="askdelete">
                      Delete
                    </button>
                  </form>
                  <?php if (isset($_POST['askdelete'])) {
                  ?>
                    <div class="fixed top-0 left-0 right-0 z-50 p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full bg-gray-500 bg-opacity-80">
                      <div class="relative w-full max-w-md max-h-full m-auto">
                        <div class="relative bg-white rounded-lg shadow">
                          <div class="p-6 text-center">
                            <svg aria-hidden="true" class="mx-auto mb-4 text-gray-400 w-14 h-14" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <h3 class="mb-5 text-lg font-normal text-gray-500">Are you sure you want to delete this product?</h3>
                            <form method="post">
                              <button type="submit" data-modal-hide="popup-modal" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                Yes, I'm sure
                              </button>
                              <button type="submit" data-modal-hide="popup-modal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">No, cancel</button>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php
                  } ?>
                </li>
              </ul>


            </div>
          </div>
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