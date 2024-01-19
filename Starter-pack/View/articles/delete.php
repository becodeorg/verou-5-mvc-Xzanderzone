<?php require 'View/includes/header.php' ?>

<h2>Confirm Delete:</h2>
<form method='POST'>
  <label for="title">title:</label>
  <input disabled='true' class='title' value=<?= $edit["title"] ?> name='title' type='text'> </input>
  <label for="description">description:</label>
  <input disabled='true' class='description' value=<?= $edit["description"] ?> name='description' type='text'> </input>
  <label for="publishdate">publishdate: </label>
  <input disabled='true' class='publishdate' value=<?= $edit["publishdate"] ?> name='publishdate' type='text'></input>
  <label for="image">image:</label>
  <input disabled='true' class='image' <?= $edit["image"] ?? '' ?> name='image' type='text'>
  </input>
  <input type="submit" style="color:red" name=delete value='confirm'>
</form>

<?php require 'View/includes/footer.php' ?>