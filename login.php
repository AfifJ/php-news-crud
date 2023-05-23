<?php
$conn = mysqli_connect("localhost", "root", "", "pwd_news");
if (!$conn)
  die("Fail to open ");

session_start();
if (isset($_SESSION['username'])) {
  echo "Sudah login dengan username " . $_SESSION['username'];
  echo "<br>";
  echo "<a href=\"index.php\">home</a>";
  die;
}
$page = "";
$response = "";

if (isset($_POST['submit'])) {
  if (empty($_POST['username']) || empty($_POST['password'])) {
    $location = $_SERVER['PHP_SELF'];
    $page = $location;
    $response = "<div class=\"p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50\" role=\"alert\">
    <span class=\"font-medium\">Username and Password can't be empty!</span>
  </div>";
  } else {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    $q = "select * from user where username = '$username'";
    $result = $conn->query($q);
    if ($result->num_rows > 0) {
      $result = $result->fetch_object();
      if ($username == $result->username) {
        if ($password == $result->password) {
          $response = "Akan diarahkan ke halaman login";
          $_SESSION['username'] = $username;
          header("location:index.php");
        } else
          $response = "<div class=\"p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50\" role=\"alert\">
          <span class=\"font-medium\">Password isn't match!</span>
        </div>";
      }
    } else {
      $response = "<div class=\"p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50\" role=\"alert\">
      <span class=\"font-medium\">Username not found</span>
    </div>";
    }
  }
}
include "inc/head.php";
?>


<body>
  <div style="margin-top:100px;">
    <div
      class=" mx-auto max-w-lg h-full p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8">
      <form class="grid place-items-center pt-10" method="post">
        <h3 class="mb-4 text-2xl font-bold leading-none tracking-tight text-gray-900 ">
          Login to Your Account</h3>
        <div class="mb-6">
          <label for="username" class="block mb-2 text-sm font-medium text-gray-900">Username</label>
          <input type="text" name="username" id="username"
            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
            placeholder="">
        </div>
        <div class="mb-6">
          <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Your
            password</label>
          <input type="password" id="password" name="password"
            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        </div>
        <?= $response ?>
        <div class="w-full">
          <button type="submit" name="submit"
            class="text-white mt-10 w-full bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Login
            Account</button>
        </div>

        <div class="mt-2">
          <div class="flex justify-between ">
            <div class="">Don't have an account?</div>
            <a href="register.php">
              <button type="button" class="text-blue-700 hover:text-blue-900 hover:underline">Register</button>
            </a>
          </div>
        </div>
      </form>
    </div>
  </div>



  </html>