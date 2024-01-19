<?php require 'View/includes/header.php' ?>

<form method='POST'>
  <label for="title">title:</label>
  <input class='title' name='title' type='text'> </input>
  <label for="description">description:</label>
  <input class='description' name='description' type='text'> </input>
  <label for="Image">Image(optional):</label>
  <input class='Image' name='Image' type='text'> </input>
  <input type="submit" value="create">
</form>

<?php require 'View/includes/footer.php' ?>