<?php
if (basename($_SERVER["PHP_SELF"]) != "index.php") {
    header("Location:../index.php?view=users");
    die("");
}

securiserAdmin("login");

$users = listerUtilisateursAdmin();
?>

<div class="top-bar">
    <h1>Gestion des utilisateurs</h1>
</div>

<div class="container">

    <div id="toast"></div>

    <div class="form-group">
        <input type="text" placeholder="Rechercher un utilisateur…"
               oninput="filtrerUsers(this.value)" />
    </div>

    <?php foreach ($users as $u):
        $isAdmin = $u['admin'] == 1;
        $isBl    = $u['blacklist'] == 1;
    ?>
    <div class="card"
         data-pseudo="<?= htmlspecialchars(strtolower($u['pseudo'])) ?>"
         data-id="<?= $u['id'] ?>"
         data-admin="<?= $isAdmin ? '1' : '0' ?>"
         data-bl="<?= $isBl ? '1' : '0' ?>"
         onclick="toggleCard(this)">

        <h3><?= htmlspecialchars($u['pseudo']) ?></h3>
        <div class="user-badges">
            <?php if ($isAdmin): ?>
                <span class="badge badge--rating">⭐ Admin</span>
            <?php endif; ?>
            <?php if ($isBl): ?>
                <span class="badge badge--danger">🚫 Blacklisté</span>
            <?php endif; ?>
        </div>

        <div class="body hidden mt-md" onclick="event.stopPropagation()">
            <div>
                <span class="badge badge--rating"><?= $u['nb_matchs_vus'] ?> matchs vus</span>
                <span class="badge badge--rating"><?= $u['nb_leagues'] ?> leagues</span>
            </div>
            <div class="action-btns mt-md"></div>
        </div>

    </div>
    <?php endforeach; ?>

</div>

<script>
function showToast(msg, ok) {
    var t = document.getElementById('toast');
    t.textContent = msg;
    t.className = ok ? 'toast toast--success' : 'toast toast--danger';
    t.style.display = 'block';
    setTimeout(function() { t.style.display = 'none'; }, 2500);
}

function fermerTous() {
    document.querySelectorAll('.body').forEach(function(p) { p.classList.add('hidden'); });
}

function toggleCard(card) {
    var body   = card.querySelector('.body');
    var isOpen = !body.classList.contains('hidden');
    fermerTous();
    if (!isOpen) {
        body.classList.remove('hidden');
        renderButtons(card);
    }
}

function renderButtons(card) {
    var isAdmin = card.dataset.admin === '1';
    var isBl    = card.dataset.bl    === '1';
    var idUser  = card.dataset.id;
    var pseudo  = card.querySelector('h3').textContent.trim();
    var wrap    = card.querySelector('.action-btns');

    wrap.innerHTML = '';

    // Blacklist / Autoriser
    var btnBl = document.createElement('button');
    if (isBl) {
        btnBl.className   = 'btn btn--success';
        btnBl.textContent = '✓ Autoriser';
        btnBl.onclick     = function() {
            if (confirm('Autoriser ' + pseudo + ' ?'))
                doAction('Autoriser', idUser, card);
        };
    } else {
        btnBl.className   = 'btn btn--danger';
        btnBl.textContent = '🚫 Blacklister';
        if (isAdmin) {
            btnBl.disabled = true;
            btnBl.title    = 'Impossible de blacklister un admin';
        } else {
            btnBl.onclick = function() {
                if (confirm('Blacklister ' + pseudo + ' ?'))
                    doAction('Interdire', idUser, card);
            };
        }
    }
    wrap.appendChild(btnBl);

    // Promouvoir / Rétrograder
    var btnAdmin = document.createElement('button');
    if (isAdmin) {
        btnAdmin.className   = 'btn btn--outline';
        btnAdmin.textContent = '↓ Rétrograder';
        btnAdmin.onclick     = function() {
            if (confirm('Rétrograder ' + pseudo + ' ?'))
                doAction('Retrograder', idUser, card);
        };
    } else {
        btnAdmin.className   = 'btn btn--primary';
        btnAdmin.textContent = '⭐ Promouvoir';
        if (isBl) {
            btnAdmin.disabled = true;
            btnAdmin.title    = 'Impossible de promouvoir un utilisateur blacklisté';
        } else {
            btnAdmin.onclick = function() {
                if (confirm('Promouvoir ' + pseudo + ' en admin ?'))
                    doAction('Promouvoir', idUser, card);
            };
        }
    }
    wrap.appendChild(btnAdmin);

    // Supprimer — interdit pour les admins
    if (!isAdmin) {
        var btnDel = document.createElement('button');
        btnDel.className   = 'btn btn--danger mt-sm';
        btnDel.textContent = '🗑 Supprimer';
        btnDel.onclick     = function() {
            if (confirm('Supprimer définitivement ' + pseudo + ' ?'))
                doAction('Supprimer', idUser, card);
        };
        wrap.appendChild(btnDel);
    }
}

function doAction(action, idUser, card) {
    var data = new FormData();
    data.append('action', action);
    data.append('idUser', idUser);

    fetch('controleur.php', {
        method: 'POST',
        body: data,
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(function(r) { return r.json(); })
    .then(function(res) {
        showToast(res.msg, res.ok);
        if (!res.ok) return;

        if (action === 'Supprimer') { card.remove(); return; }

        if (action === 'Interdire')   card.dataset.bl    = '1';
        if (action === 'Autoriser')   card.dataset.bl    = '0';
        if (action === 'Promouvoir')  card.dataset.admin = '1';
        if (action === 'Retrograder') card.dataset.admin = '0';

        // Met à jour les badges
        var badgesEl = card.querySelector('.user-badges');
        badgesEl.innerHTML = '';
        if (card.dataset.admin === '1') badgesEl.innerHTML += '<span class="badge badge--rating">⭐ Admin</span>';
        if (card.dataset.bl    === '1') badgesEl.innerHTML += '<span class="badge badge--danger">🚫 Blacklisté</span>';

        renderButtons(card);
		fermerTous();
    });
}

function filtrerUsers(val) {
    val = val.toLowerCase();
    document.querySelectorAll('[data-pseudo]').forEach(function(card) {
        card.style.display = card.dataset.pseudo.includes(val) ? '' : 'none';
    });
}
</script>
