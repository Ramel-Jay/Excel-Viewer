<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <style>
      body {
        background-color: #f4f7f6;
        font-family: 'Arial', sans-serif;
      }
      .login-card {
        border-radius: 12px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
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
    </style>
  </head>
  <body>
    <div class="container d-flex align-items-center justify-content-center vh-100">
      <div class="card login-card col-md-6 col-lg-4 p-4">
        <h4 class="text-center mb-4">Sign In</h4>
        <form action="<?= base_url('auth/loginUser') ?>" method="post">
          <?= csrf_field(); ?>
          
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" class="form-control <?= isset($validation) && $validation->hasError('email') ? 'is-invalid' : ''; ?>" value="<?= set_value('email'); ?>" name="email" id="email" placeholder="Enter your email">
            <?= isset($validation) ? '<div class="invalid-feedback">' . display_form_errors($validation, 'email') . '</div>' : ''; ?>
          </div>
          
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control <?= isset($validation) && $validation->hasError('password') ? 'is-invalid' : ''; ?>" value="<?= set_value('password'); ?>" name="password" id="password" placeholder="Enter your password">
            <?= isset($validation) ? '<div class="invalid-feedback">' . display_form_errors($validation, 'password') . '</div>' : ''; ?>
          </div>
          
          <div class="d-grid gap-2 mb-3">
            <input type="submit" class="btn btn-info" value="Sign In">
          </div>
        </form>

        <div class="footer-text">
          <p>No account? <a href="<?= site_url('auth/register') ?>">Sign up here</a></p>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
  </body>
</html>
