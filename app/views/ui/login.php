<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login | User Management</title>
  <link rel="stylesheet" href="<?= base_url() . 'public/css/auth.css' ?>">
</head>

<body>
  <div class="auth-container">
    <div class="auth-card">
      <h1 class="auth-title">Welcome Back</h1>

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

      <form action="<?= base_url() . 'auth/login' ?>" method="post">
        <div class="form-group">
          <label for="email">Email Address</label>
          <input type="email" id="email" name="email" placeholder="Enter your email" value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>" required>
        </div>

        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" placeholder="Enter your password" required>
        </div>

        <button type="submit" class="btn-primary">Login</button>

        <p class="auth-link">
          Don’t have an account? <a href="<?= base_url() . 'auth/register' ?>">Register</a>
        </p>
      </form>
    </div>
  </div>
</body>

</html>
