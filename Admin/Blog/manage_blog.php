<?php
include_once('../../link.php');
session_start();
if (!$_SESSION['Admin_Id_No']) {
  echo "<script>alert('Admin Id Not Rendered');
    location.replace('../admin_login.php');</script>";
}
error_reporting(0);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8" />
  <title>Victory Schools</title>
  <link rel="shortcut icon" href="/Victory/Images/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="/Victory/css/sidebar-style.css" />
  <!-- Boxiocns CDN Link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
  <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- Bootstrap Links -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<style>
  body {
    overflow-x: scroll;
  }

  .table-container {
    max-width: 700px;
    max-height: 500px;
    overflow-x: scroll;
  }

  @media screen and (max-width:576px) {
    .container {
      width: 80%;
      margin-left: 20%;
      overflow-x: scroll;
    }
  }

  @media print {
    * {
      display: none;
    }

    #table-container {
      display: block;
    }
  }

  #sign-out {
    display: none;
  }

  @media screen and (max-width:920px) {
    #sign-out {
      display: block;
    }
  }
</style>

<body class="bg-light">
  <?php
  include '../sidebar.php';
  ?>

  <div class="container my-4">
    <h2 class="mb-4">Manage Blog Posts</h2>
    <!-- Add Post Button -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addPostModal">
      <i class="bx bx-plus"></i> Add New Post
    </button>

    <!-- Posts Table -->
    <div class="table-responsive">
      <table class="table table-bordered table-striped">
        <thead class="table-dark">
          <tr>
            <th>ID</th>
            <th>Cover Photo</th>
            <th>Title</th>
            <th>Description</th>
            <th>Author</th>
            <th>Posted On</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $res = mysqli_query($link, "SELECT * FROM posts ORDER BY Posted_On DESC");
          while ($row = mysqli_fetch_assoc($res)) {
          ?>
            <tr>
              <td><?= $row['Post_Id']; ?></td>
              <td><img src="../../Images/blog/posts_images/<?= $row['Cover_Photo']; ?>" width="60" class="rounded"></td>
              <td><?= htmlspecialchars($row['Title']); ?></td>
              <td><?= htmlspecialchars($row['Description']); ?></td>
              <td><?= htmlspecialchars($row['Author']); ?></td>
              <td><?= date("d-m-Y H:i", strtotime($row['Posted_On'])); ?></td>
              <td>
                <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                  data-bs-target="#editPostModal<?= $row['Post_Id']; ?>">
                  <i class="bx bx-edit"></i>
                </button>
                <a href="delete_post.php?id=<?= $row['Post_Id']; ?>"
                  class="btn btn-sm btn-danger"
                  onclick="return confirm('Delete this post?')">
                  <i class="bx bx-trash"></i>
                </a>
              </td>
            </tr>

            <!-- Edit Blog Modal -->
            <div class="modal fade" id="editPostModal<?php echo $row['Post_Id']; ?>" tabindex="-1">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <form method="POST" action="" enctype="multipart/form-data">
                    <input type="hidden" name="Post_Id" value="<?php echo $row['Post_Id']; ?>">

                    <div class="modal-header">
                      <h5 class="modal-title">Edit Blog Post</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                      <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" name="Title" value="<?php echo htmlspecialchars($row['Title']); ?>" class="form-control" required>
                      </div>

                      <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="Description" class="form-control"><?php echo htmlspecialchars($row['Description']); ?></textarea>
                      </div>

                      <div class="mb-3">
                        <label class="form-label">Body</label>
                        <textarea name="Body" class="form-control" rows="6"><?php echo htmlspecialchars($row['Body']); ?></textarea>
                      </div>

                      <div class="mb-3">
                        <label class="form-label">Cover Photo (Current)</label><br>
                        <img src="../../Images/blog/posts_images/<?php echo $row['Cover_Photo']; ?>" class="img-thumbnail mb-2" width="120">
                        <input type="file" name="Cover_Photo" class="form-control" accept="image/*">
                      </div>

                      <div class="mb-3">
                        <label class="form-label">Media (max 4 images)</label>
                        <div class="d-flex flex-wrap mb-2">
                          <?php
                          $mediaFiles = !empty($row['Media']) ? explode(",", $row['Media']) : [];
                          foreach ($mediaFiles as $img) {
                            echo '<div class="me-2 mb-2 text-center">
                        <img src="../../Images/blog/posts_images/' . htmlspecialchars(trim($img)) . '" class="img-thumbnail" width="100">
                        <div><input type="checkbox" name="remove_media[]" value="' . htmlspecialchars(trim($img)) . '"> Remove</div>
                      </div>';
                          }
                          ?>
                        </div>
                        <input type="file" name="Media[]" class="form-control" accept="image/*" multiple onchange="limitFiles(this,4)">
                      </div>

                      <div class="mb-3">
                        <label class="form-label">Reference Links</label>
                        <div id="edit-links-<?php echo $row['Post_Id']; ?>">
                          <?php
                          $links = !empty($row['Links']) ? explode(",", $row['Links']) : [];
                          if (!empty($links)) {
                            foreach ($links as $link) {
                              echo '<input type="url" name="Links[]" value="' . htmlspecialchars(trim($link)) . '" class="form-control mb-2">';
                            }
                          } else {
                            echo '<input type="url" name="Links[]" class="form-control mb-2" placeholder="https://example.com">';
                          }
                          ?>
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-primary" onclick="addLinkField('edit-links-<?php echo $row['Post_Id']; ?>')">+ Add Link</button>
                      </div>

                    </div>
                    <div class="modal-footer">
                      <button type="submit" name="update" class="btn btn-success">Update</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>


          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>


  <!-- Add Blog Modal -->
  <div class="modal fade" id="addPostModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form method="POST" action="" enctype="multipart/form-data">
          <div class="modal-header">
            <h5 class="modal-title">Add Blog Post</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">

            <div class="mb-3">
              <label class="form-label">Title</label>
              <input type="text" name="Title" class="form-control" required>
            </div>

            <div class="mb-3">
              <label class="form-label">Description</label>
              <textarea name="Description" class="form-control" required></textarea>
            </div>

            <div class="mb-3">
              <label class="form-label">Body</label>
              <textarea name="Body" class="form-control" rows="6" required></textarea>
            </div>

            <div class="mb-3">
              <label class="form-label">Cover Photo</label>
              <input type="file" name="Cover_Photo" class="form-control" accept="image/*" required>
            </div>

            <div class="mb-3">
              <label class="form-label">Media (max 4 images)</label>
              <input type="file" name="Media[]" class="form-control" accept="image/*" multiple onchange="limitFiles(this,4)">
            </div>

            <div class="mb-3">
              <label class="form-label">Reference Links (optional)</label>
              <div id="add-links">
                <input type="url" name="Links[]" class="form-control mb-2" placeholder="https://example.com">
              </div>
              <button type="button" class="btn btn-sm btn-outline-primary" onclick="addLinkField('add-links')">+ Add Link</button>
            </div>

          </div>
          <div class="modal-footer">
            <button type="submit" name="add" class="btn btn-success">Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>


  <?php
  // ADD
  if (isset($_POST['add'])) {
    $title = mysqli_real_escape_string($link, $_POST['Title']);
    $desc  = mysqli_real_escape_string($link, $_POST['Description']);
    $body  = mysqli_real_escape_string($link, $_POST['Body']);

    // Handle Media (max 4 images)
    $mediaFiles = [];
    if (!empty($_FILES['Media']['name'][0])) {
      foreach ($_FILES['Media']['name'] as $key => $name) {
        if ($key >= 4) break; // max 4
        $tmp = $_FILES['Media']['tmp_name'][$key];
        $filename = time() . "_" . basename($name);
        move_uploaded_file($tmp, "../Images/blog/posts_images/" . $filename);
        $mediaFiles[] = $filename;
      }
    }
    $media = !empty($mediaFiles) ? implode(",", $mediaFiles) : NULL;

    // Handle Links (comma separated text input)
    $links = !empty($_POST['Links']) ? mysqli_real_escape_string($link, $_POST['Links']) : NULL;

    mysqli_query($link, "INSERT INTO posts (Title, Description, Body, Media, Links, Author, Posted_On) 
      VALUES ('$title', '$desc', '$body', " . ($media ? "'$media'" : "NULL") . ", " . ($links ? "'$links'" : "NULL") . ", 'School', NOW())");

    echo "<script>location.replace('manage_blog.php');</script>";
  }


  // UPDATE
  if (isset($_POST['update'])) {
    $id    = $_POST['Post_Id'];
    $title = mysqli_real_escape_string($link, $_POST['Title']);
    $desc  = mysqli_real_escape_string($link, $_POST['Description']);
    $body  = mysqli_real_escape_string($link, $_POST['Body']);

    // Update Media (replace existing if new ones uploaded)
    $mediaFiles = [];
    if (!empty($_FILES['Media']['name'][0])) {
      foreach ($_FILES['Media']['name'] as $key => $name) {
        if ($key >= 4) break;
        $tmp = $_FILES['Media']['tmp_name'][$key];
        $filename = time() . "_" . basename($name);
        move_uploaded_file($tmp, "../Images/blog/posts_images/" . $filename);
        $mediaFiles[] = $filename;
      }
    }
    $media = !empty($mediaFiles) ? implode(",", $mediaFiles) : NULL;

    // Update Links
    $links = !empty($_POST['Links']) ? mysqli_real_escape_string($link, $_POST['Links']) : NULL;

    // Build query dynamically
    $query = "UPDATE posts SET Title='$title', Description='$desc', Body='$body'";

    if ($media) {
      $query .= ", Media='$media'";
    }
    if ($links !== NULL) {
      $query .= ", Links='$links'";
    }

    $query .= " WHERE Post_Id='$id'";
    mysqli_query($link, $query);

    echo "<script>location.replace('manage_blog.php');</script>";
  }


  // DELETE
  if (isset($_POST['delete'])) {
    $id = $_POST['Post_Id'];
    mysqli_query($link, "DELETE FROM posts WHERE Post_Id='$id'");
    echo "<script>location.replace('manage_blog.php');</script>";
  }
  ?>


  <!-- Scripts -->

  <script>
    function limitFiles(input, max) {
      if (input.files.length > max) {
        alert("You can upload a maximum of " + max + " files.");
        input.value = "";
      }
    }

    function addLinkField(containerId) {
      let container = document.getElementById(containerId);
      let input = document.createElement("input");
      input.type = "url";
      input.name = "Links[]";
      input.placeholder = "https://example.com";
      input.className = "form-control mb-2";
      container.appendChild(input);
    }
  </script>
</body>

</html>