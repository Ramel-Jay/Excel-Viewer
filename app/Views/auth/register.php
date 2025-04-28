<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <style>
      body {
        background-color: #f4f7f6;
        font-family: 'Arial', sans-serif;
      }
      .register-card {
        border-radius: 12px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 30px;
        background-color: white;
      }
      .footer-text {
        text-align: center;
        margin-top: 20px;
      }
      .btn-info {
        background-color: #17a2b8;
        border-color: #17a2b8;
      }
      .btn-info:hover {
        background-color: #138496;
        border-color: #117a8b;
      }
      .alert {
        margin-bottom: 20px;
      }
    </style>
  </head>
  <body>
    <div class="container d-flex align-items-center justify-content-center vh-100">
      <div class="card register-card col-md-8 col-lg-6">
        
        <h4 class="text-center mb-4">Register</h4>

        <?php if (!empty(session()->getFlashData('success'))) { ?>
          <div class="alert alert-success">
            <?= session()->getFlashData('success') ?>
          </div>
        <?php } else if (!empty(session()->getFlashData('fail'))) { ?>
          <div class="alert alert-danger">
            <?= session()->getFlashData('fail') ?>
          </div>
        <?php } ?>

        <form action="<?= base_url('auth/registerUser') ?>" method="post">
          <?= csrf_field(); ?>

          <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control <?= isset($validation) && $validation->hasError('name') ? 'is-invalid' : ''; ?>" value="<?= set_value('name') ?>" name="name" id="name" placeholder="Enter your name">
            <div class="invalid-feedback"><?= isset($validation) ? display_form_errors($validation, 'name') : ''; ?></div>
          </div>

          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" class="form-control <?= isset($validation) && $validation->hasError('email') ? 'is-invalid' : ''; ?>" value="<?= set_value('email') ?>" name="email" id="email" placeholder="Enter your email">
            <div class="invalid-feedback"><?= isset($validation) ? display_form_errors($validation, 'email') : ''; ?></div>
          </div>

          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control <?= isset($validation) && $validation->hasError('password') ? 'is-invalid' : ''; ?>" name="password" id="password" placeholder="Enter your password">
            <div class="invalid-feedback"><?= isset($validation) ? display_form_errors($validation, 'password') : ''; ?></div>
          </div>

          <div class="mb-3">
            <label for="confirmPassword" class="form-label">Confirm Password</label>
            <input type="password" class="form-control <?= isset($validation) && $validation->hasError('confirmPassword') ? 'is-invalid' : ''; ?>" name="confirmPassword" id="confirmPassword" placeholder="Confirm your password">
            <div class="invalid-feedback"><?= isset($validation) ? display_form_errors($validation, 'confirmPassword') : ''; ?></div>
          </div>

          <div class="d-grid gap-2 mb-3">
            <input type="submit" class="btn btn-info" value="Register">
          </div>
        </form>

        <div class="footer-text">
          <p>Already have an account? <a href="<?= site_url('auth/login') ?>">Login here</a></p>
        </div>
        
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
  </body>
</html>
