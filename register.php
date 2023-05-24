<?php
session_start();

include "inc/conn.php";

if (isset($_SESSION['username'])) {
  echo "Sudah login dengan username " . $_SESSION['username'];
  echo "<br>";
  echo "<a href=\"homepage.php\">home</a>";
  die;
}

$page = "";
$response = "";

if (isset($_POST['submit'])) {
  if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['repeatPassword'])) {
    $response = "Username dan password harus diisi";
  } else {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $rePassword = htmlspecialchars($_POST['repeatPassword']);

    $q = "select * from user where username = '$username'";
    $result = $conn->query($q);
    if ($result->num_rows > 0) {
      $result = $result->fetch_object();
      if ($username == $result->username) {
        $response = "Sudah ada akun dengan username ini";
      }
    } else if ($password != $rePassword) {
      $response = "Password tidak cocok";
    } else {
      $response = "Dilakukan register";
      $q = "insert into user (username, password, role) values ('$username','$password','user')";
      $_SESSION['username'] = $username;
      if ($conn->query($q))
        header("location:index.php");
      else
        $response = "Terjadi kesalahan";
    }
  }
}
include "inc/head.php";
?>

<body>
  <div class="container mx-auto max-w-lg h-full">
    <form class="grid place-items-center pt-10" method="post">
      <h3 class="mb-4 text-2xl font-bold leading-none tracking-tight text-gray-900 ">
        Make Your Account</h3>
      <div class="mb-6">
        <label for="username" class="block mb-2 text-sm font-medium text-gray-900">Username</label>
        <input type="text" name="username" id="username"
          class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
          placeholder="">
      </div>
      <div class="mb-6">
        <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Make a
          password</label>
        <input type="password" id="password" name="password"
          class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
      </div>
      <div class="mb-6">
        <label for="repeat-password" class="block mb-2 text-sm font-medium text-gray-900">Repeat
          password</label>
        <input type="password" id="repeat-password" name="repeatPassword"
          class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
      </div>
      <div class="flex items-start mb-6">
        <div class="flex items-center h-5">
          <input id="terms" type="checkbox" value=""
            class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800"
            required>
        </div>
        <label for="terms" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">I agree with the <a
            href="#" class="text-blue-600 hover:underline dark:text-blue-500">terms and conditions</a></label>
      </div>

      <?= $response ?>
      <div class="w-full">
        <button type="submit" name="submit"
          class="text-white mt-10 w-full bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Login
          Account</button>
      </div>

      <div class="mt-10">
        <div class="flex justify-between ">
          <div class="">Have an account?</div>
          <a href="login.php">
            <button type="button" class="text-blue-700 hover:text-blue-900 hover:underline">Login</button>
          </a>
        </div>
      </div>
    </form>
  </div>


</body>

</html>