<?php require 'View/includes/header.php' ?>

<form method='POST'>
  <label for="title">title:</label>
  <input class='title' value=<?= $edit["title"] ?> name='title' type='text'> </input>
  <label for="description">description:</label>
  <input class='description' value=<?= $edit["description"] ?> name='description' type='text'> </input>
  <label for="publishdate">publishdate: </label>
  <input class='publishdate' value=<?= $edit["publish_date"] ?> name='publishdate' type='text'></input>
  <label for="image">image:</label>
  <input class='image' name='image' type='text' value=<?= $edit["image"] ?? '' ?>>
  </input>
  <input type="submit" value='confirm changes'>
</form>

<?php require 'View/includes/footer.php' ?>