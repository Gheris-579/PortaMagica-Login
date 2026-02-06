<?php require __DIR__ . '/../partials/header.php'; ?>

<div class="container" style="max-width: 530px;">
    <h1 class="text-center mb-4">REGISTER</h1>

    <?php if (!empty($success)): ?>
        <div class="alert alert-success">
            <?= htmlspecialchars($success) ?>
            <div class="mt-2">
                <a href="login.php">Vai al login</a>
            </div>
        </div>
    <?php endif; ?>

    <?php if (!empty($errors) && is_array($errors)): ?>
        <?php foreach ($errors as $e): ?>
            <div class="alert alert-danger">
                <?= htmlspecialchars((string)$e) ?>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

    <form method="post" novalidate>
        <div class="mb-3">
            <label class="form-label">Username</label>
            <input
                    id="loginField"
                    type="text"
                    name="username"
                    class="form-control"
                    value="<?= htmlspecialchars($old['username'] ?? '') ?>"
                    required
            >
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input
                    id="loginField"
                    type="email"
                    name="email"
                    class="form-control"
                    value="<?= htmlspecialchars($old['email'] ?? '') ?>"
                    required
            >
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input
                    id="passwordField"
                    type="password"
                    name="password"
                    class="form-control"
                    required
            >
        </div>

        <div class="mb-3">
            <label class="form-label">Ripeti password</label>
            <input
                    id="passwordField"
                    type="password"
                    name="password2"
                    class="form-control"
                    required
            >
        </div>

        <button type="submit"  class="btn btn-success w-100">
            CREA ACCOUNT
        </button>
        <p class="text-center mb-0">
            Hai già un account? <a href="login.php">Login</a>
        </p>
    </form>
    <h2 class="ml11 text-center mb-4">
  <span class="text-wrapper">
    <span class="line"></span>
    <span class="letters">Created by Gheris</span>
  </span>
    </h2>

</div>


<?php require __DIR__ . '/../partials/footer.php'; ?>
