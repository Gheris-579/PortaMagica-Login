<?php require __DIR__ . '/../partials/header.php'; ?>

<div class="container" style="max-width: 700px;">
    <h1 class="animate__animated animate__fadeInDown mb-3">Dashboard</h1>

    <div class="alert alert-info">
        Ciao <b><?= htmlspecialchars($_SESSION['username']) ?></b> ✅
    </div>

    <p>Questa pagina è protetta: la vedi solo se sei loggato.</p>

    <a class="btn btn-outline-danger" href="logout.php">Logout</a>
</div>

<?php require __DIR__ . '/../partials/footer.php'; ?>
