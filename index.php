<?php
session_start();
include "inc/conn.php";
include "inc/head.php";

$response = "";
$jumlahTampil = 4;

$currentPage = 0;
if (isset($_GET['p'])) {
  $currentPage = $_GET['p'];
}

if ($currentPage < 0) {
  $currentPage = 0;
}

$before = $currentPage * $jumlahTampil;
$file = $conn->query("select * from news inner join publish where news.id = publish.news_id order by publish.date desc limit $before, $jumlahTampil");
$totalData = $conn->query("select * from news")->num_rows;

if (isset($_POST['signoutsure'])) {
  session_destroy();
  header("location:index.php");
}
/* if (!isset($_SESSION['username'])) {
  ?>
  <!-- Main modal -->
  <div class="w-screen h-screen bg-gray-900 bg-opacity-80 fixed inset-0 z-40 grid place-items-center backdrop-blur-md">

    <!-- Modal content -->
    <div class="bg-white rounded-lg shadow w-1/2">

      <!-- Modal header -->
      <div class="px-6 py-4 border-b rounded-t">
        <h3 class="text-base font-semibold text-gray-900 text-xl lg:text-3xl">
          Login First
        </h3>
      </div>
      <!-- Modal body -->
      <div class="p-6">
        <p class="text-sm font-normal text-gray-500">You have to log in to access this website</p>
        <a href="login.php"
          class="mt-6 flex items-center p-3 text-base font-bold text-gray-900 rounded-lg bg-blue-50 hover:bg-blue-100 group hover:shadow">
          <span class="flex-1 whitespace-nowrap text-center">Login</span>
        </a>
      </div>
    </div>
  </div>
  <?php
}
 */
if (isset($_GET['s'])) {
  $s = $_GET['s'];

  $jumlahTampil = 2;
  $before = $currentPage * $jumlahTampil;
  /*   $file = $conn->query("select * from news inner join publish on news.id = publish.news_id where news.content like '%$s%' order by publish.date desc");
   */
  $file = $conn->query("select * from news inner join publish on news.id = publish.news_id where news.title like '%$s%' order by publish.date desc limit $before, $jumlahTampil");


  $totalData = $conn->query("select * from news inner join publish on news.id = publish.news_id where news.title like '%$s%'")->num_rows;
}
?>


<body class="bg-white flex flex-col min-h-screen">

  <nav class="bg-white border-gray-200 sticky top-0 shadow-xl">
    <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl p-4">
      <!-- brand -->
      <a href="index.php" class="flex items-center">
        <img src="img/logo.png" class="h-8 mr-3" alt="Logo" />
      </a>

      <!-- brand -->
      <div class="flex items-center">
        <form class="hidden md:inline mx-5" method="get">
          <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only ">Search</label>
          <div class="relative">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
              <svg aria-hidden="true" class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
              </svg>
            </div>
            <?php
            $svalue = "";
            if (isset($_GET['s'])) $svalue = $_GET['s'];
            ?>
            <input type="search" id="default-search" name="s" class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" placeholder="Search Title" value="<?= $svalue ?>">
            <button type="submit" class="text-white absolute right-2.5 bottom-2.5 bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">Search</button>
          </div>
        </form>
        <?php

        if (isset($_SESSION['username'])) {
        ?>
          <button id="dropdownButton" data-dropdown-toggle="dropdown" class="inline-flex items-center justify-center w-full px-8 py-2 text-base font-bold leading-6 text-white bg-blue-600 border border-transparent rounded-full md:w-auto hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-600">
            <svg aria-hidden="true" class="w-5 h-5 mr-3 my-auto fill-current" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd"></path>
            </svg>
            <span class="capitalize">
              <?= $_SESSION['username'] ?>
            </span>

          </button>

          <!-- Dropdown menu -->
          <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
            <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownButton">
              <li>
                <a href="dashboard/input.php" class="block px-4 py-2 hover:bg-gray-100 text-center">Write a News</a>
              </li>
              <li>
                <a href="dashboard/index.php" class="block px-4 py-2 hover:bg-gray-100 text-center">Dashboard</a>
              </li>
              <li>
                <form method="post">
                  <button class="block px-4 py-2 w-full hover:bg-gray-100" type="submit" name="signout"> Sign out
                  </button>
                </form>
              </li>
            </ul>
          </div>

        <?php
        } else {
        ?>
          <a href="login.php">
            <button class="inline-flex items-center justify-center w-full px-8 py-2 text-base font-bold leading-6 text-white bg-blue-600 border border-transparent rounded-full md:w-auto hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-600" type="button">
              Login
            </button>
          </a>
        <?php
        }
        ?>
      </div>
    </div>
  </nav>

  <div class="flex-shrink max-w-full w-full lg:pl-8 lg:pb-8">
    <div class="w-full bg-gray-50 h-full">
      <div class="text-sm py-6">
        <div class="w-full text-center">
          <span class="uppercase font-bold">Latest news</span>
        </div>
      </div>
    </div>
  </div>


  <div class="grid place-items-center mr-6 ml-6">
    <div class="mx-auto my-10 grid gap-4 lg:grid-cols-2 max-w-6xl place-items-center">
      <?php
      if (isset($_GET['s']) &&  $totalData < 1) {
      ?>
        <p>News with title <?= $_GET['s'] ?> is not exist</p>
        <?php
      } else {
        while ($article = $file->fetch_object()) {
          $title = $article->title;
          $image = $article->image;
          $desc = $article->content;
        ?>
          <div class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow w-full md:h-48 md:flex-row md:max-w-xl hover:bg-gray-100 cursor-pointer">
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
          </div>
      <?php
        }
      }

      ?>
    </div>
  </div>
  <div class="w-full flex flex-row justify-center mb-5">
    <?php
    if ($currentPage > 0) {
    ?>
      <form class="mx-3" method="get">
        <?php
        if (isset($_GET['s'])) {
        ?>
          <input type="hidden" name="s" value="<?= $_GET['s'] ?>">
        <?php
        }
        ?>
        <input type="hidden" name="p" value="<?= $currentPage - 1 ?>">
        <button class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2" type="submit">
          Prev page
        </button>
      </form>
    <?php
    } else {
    ?>
      <form class="mx-3" method="get">
        <button class="text-gray-300 bg-white border border-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2" type="submit" disabled>
          Prev page
        </button>
      </form>
    <?php
    }
    if (($currentPage + 1) * $jumlahTampil < $totalData) {
    ?>
      <form class="mx-3" method="get">
        <?php
        if (isset($_GET['s'])) {
        ?>
          <input type="hidden" name="s" value="<?= $_GET['s'] ?>">
        <?php
        }
        ?>
        <input type="hidden" name="p" value="<?= $currentPage + 1 ?>">
        <button class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2" type="submit">
          Next page
        </button>
      </form>
    <?php
    } else {
    ?>

      <form class="mx-3">
        <button class="text-gray-300 bg-white border border-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2" type="submit">
          Next page
        </button>
      </form>

    <?php
    }
    ?>
  </div>
  <?php
  if (!isset($_SESSION['username'])) :
  ?>
    <div class="text-center mb-8">
      <a href="">
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 ">You're a guest</h5>
      </a>
      <p class="mb-3 font-normal text-gray-700">Login so you can write your news. ^^</p>
      <a href="login.php" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-600 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
        Login
        <svg aria-hidden="true" class="w-4 h-4 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
        </svg>
      </a>
    </div>

  <?php

  endif;

  ?>


  <?php

  if (isset($_POST['signout'])) {
  ?>
    <div class="w-screen h-screen bg-gray-900 bg-opacity-80 fixed inset-0 z-40 grid place-items-center backdrop-blur-md">

      <div class="z-50 p-4 overflow-x-hidden overflow-y-auto md:inset-0">
        <div class="relative w-full max-w-md">
          <div class="relative bg-white rounded-lg shadow m-auto">
            <div class="p-6 text-center">
              <svg aria-hidden="true" class="mx-auto mb-4 text-gray-400 w-14 h-14" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
              </svg>
              <h3 class="mb-5 text-lg font-normal text-gray-500">Are you sure you want to
                signout?</h3>
              <form method="post">
                <button name="signoutsure" type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                  Yes, I'm sure
                </button>
                <button class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">No,
                  cancel</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php

  }
  ?>


  <?php
  include "inc/foot.php";

  ?>