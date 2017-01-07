<?php
if (empty($_POST) === false) {
  // echo '<pre>', print_r($_POST, true), '</pre>';
  $errors = array();

  $name     =   $_POST['name'];
  $email    =   $_POST['email'];
  $message  =   $_POST['message'];

  // echo $name, ' ', $email, ' ', $message;

  if (empty($name) === true || empty($email) === true || empty($message) === true) {
    $errors[] = 'Name, email and message are required';
  } else {
    if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
      $errors[] = 'Please enter a valid email address';
    }
    if (ctype_alpha($name) === false) {
      $errors[] = 'Name can only contain letters';
    }
  }

  if (empty($errors) === true) {
    mail('email@email.com', 'Message via website form', $message, 'From: ' . $email);
    header('Location: index.php?sent');
    exit();
  }


  // print_r($errors);
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Contact Us</title>
  </head>
  <body>
    <?php
      if (isset($_GET['sent']) === true) {
        echo '<p>Thanks for contacting us</p>';
      }
      else {
          if (empty($errors) === false) {
              echo '<ul>';
            foreach ($errors as $error) {
              echo '<li>', $error, '</li>';
          }
            echo '</ul>';
      }
    ?>
    <form method="POST">
      <p>
        <label for="name">Name:</label><br>
        <input type="text" name="name" id="name" <?php if (isset($_POST['name']) === true) {
          echo 'value="', strip_tags($_POST['name']), '"';
        } ?>>
      </p>
      <p>
        <label for="email">Email:</label><br>
        <input type="text" name="email" id="email" <?php if (isset($_POST['email']) === true) {
          echo 'value="', strip_tags($_POST['email']), '"';
        } ?>>
      </p>
      <p>
        <label for="message">Message:</label><br>
        <textarea name="message" id="message"><?php
        if (isset($_POST['message']) === true) {
          echo strip_tags($_POST['message']);
        } ?></textarea>
      </p>
      <p>
        <input type="submit">
      </p>
    </form>
    <?php
      }
     ?>
  </body>
</html>
