<?php

session_start();
$loginBtn = "<button name=\"logout\">Logout</button>";
if (!isset($_SESSION['username'])) {
  $loginBtn = "<button name=\"login\">Login</button>";
  $username = "";
}

if (isset($_POST['login'])) {
  header("location:login.php");
}

if (isset($_POST['logout'])) {
  session_unset();
  header("location:index.php");
}


$file = json_decode(file_get_contents("today.json"))->today->articles;

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Homepage</title>
  <link href="https://cdn.jsdelivr.net/npm/daisyui@2.51.6/dist/full.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="css\syle.css">
  <script>
    tailwind.config = {
      theme: {
        colors: {
          rome: {
            50: "#ebdec8",
            100: "#e3cbab",
            200: "#d49f79",
            300: "#c56e51",
            400: "#b53b34",
            500: "#a4243b",
            600: "#921f52",
            700: "#802067",
            800: "#69246d",
            900: "#45275a",
          }
        },
        extend: {
          colors: {
            clifford: '#da373d',
          }
        }
      }
    }
  </script>
</head>

<body>


  <!-- 
  <nav class="bg-white dark:bg-gray-900 sticky w-full z-20 top-0 left-0 border-b border-gray-200 dark:border-gray-600">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
      <a href="https://flowbite.com/" class="flex items-center">
        <img src="https://flowbite.com/docs/images/logo.svg" class="h-8 mr-3" alt="Flowbite Logo">
        <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Flowbite</span>
      </a>
      <div class="flex md:order-2">
        <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center mr-3 md:mr-0 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Get started</button>
        <button data-collapse-toggle="navbar-sticky" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-sticky" aria-expanded="false">
          <span class="sr-only">Open main menu</span>
          <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
          </svg>
        </button>
      </div>
      <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
        <ul class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
          <li>
            <a href="#" class="block py-2 pl-3 pr-4 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 md:dark:text-blue-500" aria-current="page">Home</a>
          </li>
          <li>
            <a href="#" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">About</a>
          </li>
          <li>
            <a href="#" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Services</a>
          </li>
          <li>
            <a href="#" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Contact</a>
          </li>
        </ul>
      </div>
    </div>
  </nav> -->


  <nav class="navbar sticky top-0 bg-base-100 drop-shadow-xl">
    <div class="flex-1">
      <a class="btn btn-ghost normal-case text-xl text-white">TailNews</a>
    </div>
    <div class="flex-none">
      <ul class="menu menu-horizontal px-1">
        <li><a>Browse</a></li>
        <li tabindex="0">
          <a>
            Category
            <svg class="fill-current" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
              <path d="M7.41,8.58L12,13.17L16.59,8.58L18,10L12,16L6,10L7.41,8.58Z" />
            </svg>
          </a>
          <ul class="p-2 bg-base-100">
            <li><a>World</a></li>
            <li><a>Science</a></li>
            <li><a>Health</a></li>
          </ul>
        </li>
      </ul>
    </div>
    <?php

    if (isset($_SESSION['username'])) {
      ?>
      <div class="flex-none">
        <div class="dropdown dropdown-end">
          <label tabindex="0" class="btn btn-ghost btn-circle avatar">
            <div class="w-10 rounded-full">
              <img src="https://daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg" />
            </div>
          </label>
          <ul tabindex="0" class="menu menu-compact dropdown-content mt-3 p-2 shadow bg-base-100 rounded-box w-52">
            <li>
              <a class="justify-between">
                Profile
                <span class="badge">New</span>
              </a>
            </li>
            <li><a>Write</a></li>
            <li><a>Settings</a></li>
            <li>
              <form method="post">
                <button name="logout">Logout</button>
              </form>
            </li>
          </ul>
        </div>
      </div>
      <?php
    } else {
      ?>
      <div class="flex-none mx-3">
        <a href="login.php"><button class="btn btn-primary rounded-full px-10">Login</button></a>
      </div>
      <?php
    }
    ?>
  </nav>


  <!-- block news -->
  <div class="bg-white">
    <div class="xl:container mx-auto px-3 sm:px-4 xl:px-2">
      <div class="flex flex-row flex-wrap">

        <!-- Left -->
        <div class="flex-shrink max-w-full w-full lg:w-2/3 overflow-hidden">

          <div class="w-full py-3">
            <h2 class="text-gray-800 text-2xl font-bold">
              <span class="inline-block h-5 border-l-3 border-red-600 mr-2"></span>Today's News
            </h2>
          </div>

          <div class="flex flex-row flex-wrap -mx-3">
            <?php
            $i = 1;
            foreach ($file as $article) {
              $date = date_format(date_create($article->publishedAt), "M d, Y");
              //  T21:38:11Z
              if ($i > 9)
                break;
              $title = $article->title;
              $image = $article->image;
              $desc = $article->description;

              ?>
              <div class="flex-shrink max-w-full w-full sm:w-1/3 px-3 pb-3 pt-3 sm:pt-0 border-b-2 sm:border-b-0
                border-dotted border-gray-100">
                <div class="flex flex-row sm:block hover-img">
                  <a href="">
                    <img class="max-w-full w-full mx-auto" src="<?= $image ?>" alt="alt title">
                  </a>
                  <div class="py-0 sm:py-3 pl-3 sm:pl-0">
                    <h3 class="text-lg font-bold leading-tight mb-2">
                      <a href="#">
                        <?= $title ?>
                      </a>
                    </h3>
                    <p class="hidden md:block text-gray-600 leading-tight mb-1">
                      <?= $desc ?>
                    </p>
                    <a class="text-gray-500" href="#"><span class="inline-block h-3 border-l-2 border-red-600
                        mr-2"></span>Europe</a>
                  </div>
                </div>
              </div>
              <?php
              $i++;
            }
            ?>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.tailwindcss.com"></script>
</body>

</html>