<?php
include "../inc/conn.php";
session_start();
if (!isset($_SESSION['username']))
  header("location:../index.php");

$userid = $_SESSION['userid'];
if (isset($_POST['submit'])) {
  $title = filter_var(htmlspecialchars($_POST['title'], FILTER_SANITIZE_ADD_SLASHES));
  $image = filter_var(htmlspecialchars($_POST['image'], FILTER_SANITIZE_ADD_SLASHES));
  $content = filter_var(htmlspecialchars($_POST['content'], FILTER_SANITIZE_ADD_SLASHES));
  $q = "";
  $q = "insert into news (title, content, image) values ('$title', '$content', '$image');";
  if ($conn->query($q)) {
    $newsid = mysqli_insert_id($conn);
    date_default_timezone_set('Asia/Jakarta');
    $date = date('d-m-y h:i:s');
    $q = "insert into publish (user_id,news_id,date) values ('$userid', '$newsid','$date')";
    if ($conn->query($q))
      header("location:index.php");
  }
}
include "../inc/head.php";
include "inc/navbar.php";
?>

<div class="p-4 sm:ml-64">
  <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg mt-14">
    <?php if (!isset($_POST['update'])) { ?>
      <form method="post">
        <div class="mb-6">
          <label for="newsid" class="block mb-2 text-sm font-medium text-gray-900">News ID</label>
          <select name="newsid" id="newsid" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            <?php $q = "SELECT id FROM news";
            $results = $conn->query($q);
            while ($result = $results->fetch_object()) {
            ?>
              <option value="<?= $result->id ?>" default><?= $result->id ?></option>
            <?php
            }
            ?>
          </select>
        </div>
        <div class="mb-6">
          <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" name="update">Update</button>
        </div>
      </form>
    <?php } ?>
    <?php
    if (isset($_POST['update'])) {
      $NewsID = $_POST['newsid'];
    ?>
      <form method="post">
        <div class="mb-6">
          <label for="newsid" class="block mb-2 text-sm font-medium text-gray-900">News id</label>
          <input type="text" id="newsid" name="id" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="<?= $NewsID ?>" disabled>
        </div>
        <?php

        $q = "SELECT title, content, image FROM news WHERE id = '$NewsID'";
        $result = $conn->query($q)->fetch_object();
        $title = $result->title;
        $image = $result->image;
        $content = $result->content;
        ?>
        <div class="mb-6">
          <label for="title" class="block mb-2 text-sm font-medium text-gray-900">Your title</label>
          <input type="text" id="title" name="title" value="<?= $title ?>" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="" required>
        </div>
        <div class="mb-6">
          <label for="image" class="block mb-2 text-sm font-medium text-gray-900">Your image link</label>
          <input type="text" id="image" name="image" value="<?= $image ?>" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="https://www...">
        </div>
        <label for="message" class="block mb-2 text-sm font-medium text-gray-900">Content</label>
        <textarea id="message" rows="4" name="content" class="block mb-6 p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="" required><?= $content ?></textarea>
        <button type="submit" name="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Publish</button>


      </form>
    <?php
    }

    ?>





  </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
</body>

</html>