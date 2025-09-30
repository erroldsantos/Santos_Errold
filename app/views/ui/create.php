<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Create Account</title>
  <link rel="stylesheet" href="https://santos-errold.onrender.com/public/css/create.css">
</head>
<body>
  <div class="container">
    <div class="card">
      <header class="card-header">
        <h2>Create Account</h2>
        <p>Please fill in the details below</p>
      </header>

      <form id="account-form" method="POST" class="form-body">
        <div class="input-group">
          <label for="first_name">First Name</label>
          <input type="text" id="first_name" name="first_name" placeholder="John" required />
        </div>

        <div class="input-group">
          <label for="last_name">Last Name</label>
          <input type="text" id="last_name" name="last_name" placeholder="Doe" required />
        </div>

        <div class="input-group">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" placeholder="john@example.com" required />
        </div>

        <div class="form-footer">
          <button type="submit" class="btn-primary">Submit</button>
          <a href="<?= base_url() ?>users" class="btn-secondary">Cancel</a>
        </div>
      </form>
    </div>
  </div>
</body>
</html>