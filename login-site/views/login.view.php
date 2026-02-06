<?php require __DIR__ . '/../partials/header.php'; ?>

<div class="auth-box" style="max-width: 530px;">
    <h1 id="name" class="animate__animated animate__backInDown">LOGIN FORM</h1>

    <?php if (!empty($errors) && is_array($errors)): ?>
        <?php foreach ($errors as $e): ?>
            <div class="alert alert-danger">
                <?= htmlspecialchars((string)$e) ?>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

    <form method="post" novalidate>
        <div class="mb-3">
            <label class="form-label">Username o Email</label>
            <input
                    id="loginField"
                    type="text"
                    name="login"
                    class="form-control"
                    placeholder="Username o Email"
                    value="<?= htmlspecialchars($old['login'] ?? '') ?>"
                    required
            >
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input
                    id="passwordField"
                    type="password"
                    name="password"
                    class="form-control"
                    placeholder="Password"
                    required
            >
        </div>

        <button type="submit" id="btnlog" class="btn btn-primary">
            LOGIN
        </button>
        <p id="nonhai" class="text-center mb-0">
            Non hai un account? <a href="register.php">Registrati</a>
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
