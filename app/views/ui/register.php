<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register | User Management</title>
  <link rel="stylesheet" href="<?= base_url() . 'public/css/auth.css' ?>">
</head>

<body>
  <div class="auth-container">
    <div class="auth-card">
      <h1 class="auth-title">Create Account</h1>

      <?php if (isset($error)): ?>
        <div class="error-message" style="color: red; margin-bottom: 15px; padding: 10px; border: 1px solid red; border-radius: 4px; background-color: #ffe6e6;">
          <?= $error ?>
        </div>
      <?php endif; ?>

      <?php if (isset($success)): ?>
        <div class="success-message" style="color: green; margin-bottom: 15px; padding: 10px; border: 1px solid green; border-radius: 4px; background-color: #e6ffe6;">
          <?= $success ?>
        </div>
      <?php endif; ?>

      <form action="<?= base_url() . 'auth/register' ?>" method="post">
        <div class="form-group">
          <label for="first_name">First Name</label>
          <input type="text" id="first_name" name="first_name" placeholder="Enter your first name" value="<?= isset($_POST['first_name']) ? htmlspecialchars($_POST['first_name']) : '' ?>" required>
        </div>

        <div class="form-group">
          <label for="last_name">Last Name</label>
          <input type="text" id="last_name" name="last_name" placeholder="Enter your last name" value="<?= isset($_POST['last_name']) ? htmlspecialchars($_POST['last_name']) : '' ?>" required>
        </div>

        <div class="form-group">
          <label for="email">Email Address</label>
          <input type="email" id="email" name="email" placeholder="Enter your email" value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>" required>
        </div>

        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" placeholder="Create a password" required>
        </div>

        <button type="submit" class="btn-primary">Register</button>

        <p class="auth-link">
          Already have an account? <a href="<?= base_url() . 'auth/login' ?>">Login</a>
        </p>
      </form>
    </div>
  </div>
</body>

</html>
