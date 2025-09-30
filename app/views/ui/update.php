<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Student</title>
  <link rel="stylesheet" href="https://santos-errold.onrender.com/public/css/style.css">
  <link rel="stylesheet" href="https://santos-errold.onrender.com/public/css/update.css">
</head>

<body>
  <div id="update-container" class="container">
    <div id="update-card" class="card">
      <header id="update-header" class="header">
        <h2>Edit Account</h2>
      </header>
      
      <form id="update-student-form" method="POST">
        <div class="form-group">
          <input 
            type="text" 
            id="update-first-name"
            name="first_name" 
            value="<?= $user['first_name'] ?>" 
            placeholder="Enter first name"
            required
          >
        </div>
        
        <div class="form-group">
          <input 
            type="text" 
            id="update-last-name"
            name="last_name" 
            value="<?= $user['last_name'] ?>" 
            placeholder="Enter last name"
            required
          >
        </div>
        
        <div class="form-group">
          <input 
            type="email" 
            id="update-email"
            name="email" 
            value="<?= $user['email'] ?>" 
            placeholder="Enter email address"
            required`
          >
        </div>
        
        <div class="form-actions">
          <button type="submit" id="update-submit-btn" class="btn-primary">
            <span class="btn-text">Update Acount</span>
          </button>
          <a id="back-from-update" class="btn-secondary" href="<?= base_url() ?>users">
            Back to Main Page
          </a>
        </div>
      </form>
    </div>
  </div>
</body>



</html>