<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Students List</title>
  <link rel="stylesheet" href="<?= base_url() . 'public/css/style.css' ?>">
  <link rel="stylesheet" href="<?= base_url() . 'public/css/get_all.css' ?>">
</head>

<body>
  <div class="main-container">
    <header class="page-header">
      <h1 class="form-title">USERS MANAGEMENT</h1>
      <div style="display: flex; align-items: center; gap: 15px;">
        <?php if (isset($current_user)): ?>
          <span style="color: #1a0e0eff; font-size: 20px; font-family: 'Franklin Gothic Medium';">
            Welcome, <?= htmlspecialchars($current_user['first_name'] . ' ' . $current_user['last_name']) ?>
          </span>
        <?php endif; ?>
        <a id="btn-add-user" class="btn btn-primary" href="<?= base_url() . 'users/create' ?>">
          <span>Add New Account</span>
        </a>
        <form method="get" action="/users/get-all">
          <input id="search-user" type="text" name="search" value="<?= $search ?? '' ?>" placeholder="Search...">
        </form>
        <button id="btn-logout" class="btn btn-danger1 btn-small" onclick="window.location.href='<?= base_url() . 'auth/logout' ?>'">
          Logout
        </button>
      </div>
    </header>
    <div class="data-card">
      <table class="data-table" id="students-table">
        <thead>
          <tr>
            <th scope="col">User ID</th>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
            <th scope="col">Email Address</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($records as $user): ?>
            <tr id="student-row-<?= $user['id'] ?>">
              <td data-label="Student ID"><?= htmlspecialchars($user['id']) ?></td>
              <td data-label="First Name"><?= htmlspecialchars($user['first_name']) ?></td>
              <td data-label="Last Name"><?= htmlspecialchars($user['last_name']) ?></td>
              <td data-label="Email"><?= htmlspecialchars($user['email']) ?></td>
              <td data-label="Actions" class="table-actions">
                <a href="<?= base_url() . 'users/update/' . $user['id'] ?>" class="btn btn-secondary btn-small"
                  aria-label="Edit <?= htmlspecialchars($user['first_name'] . ' ' . $user['last_name']) ?>">
                  Edit
                </a>
                <button type="button" class="btn btn-danger btn-small"
                  onclick="confirmDelete('<?= $user['id'] ?>', '<?= htmlspecialchars($user['first_name'] . ' ' . $user['last_name']) ?>')"
                  aria-label="Delete <?= htmlspecialchars($user['first_name'] . ' ' . $user['last_name']) ?>">
                  Delete
                </button>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <?php if (isset($pagination_data)): ?>
      <div>
        <?php if (!empty($pagination_links)): ?>
          <div>
            <?php
            if (!empty($pagination_links) && !empty($search)) {
              $pagination_links = preg_replace_callback(
                '/href="([^"]*)"/',
                function ($matches) use ($search) {
                  $url = $matches[1];
                  $separator = (strpos($url, '?') === false) ? '?' : '&';
                  return 'href="' . $url . $separator . 'search=' . urlencode($search) . '"';
                },
                $pagination_links
              );
            }
            ?>
            <?php echo $pagination_links; ?>
          </div>
        <?php endif; ?>

        <div id="pagination-info">
          <div><?php echo $pagination_data['info']; ?></div>
        </div>
      </div>
    <?php endif; ?>
  </div>

  <script>
    function confirmDelete(studentId, studentName) {
      if (confirm(`Are you sure you want to delete ${studentName}? This action cannot be undone.`)) {
        window.location.href = '<?= base_url() ?>users/delete/' + studentId;
      }
    }
  </script>
</body>



</html>