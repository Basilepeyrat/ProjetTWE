<?php
if (basename($_SERVER["PHP_SELF"]) != "index.php") {
    header("Location:../index.php?view=users");
    die("");
}

securiserAdmin("login");
$users = listerUtilisateursAdmin();
?>

<div class="top-bar">
    <h1>Utilisateurs</h1>
</div>

<div class="container">

    <div id="message" ></div>

    <div class="form-group">
        <input type="text" placeholder="Rechercher…" oninput="filtrerUsers(this.value)" />
    </div>

    <?php foreach ($users as $u):
        $admin = $u['admin'] == 1;
        $bl    = $u['blacklist'] == 1;
    ?>
    <div class="card"
         data-pseudo="<?= strtolower($u['pseudo']) ?>"
         data-id="<?= $u['id'] ?>"
         data-admin="<?= $admin ? '1' : '0' ?>"
         data-bl="<?= $bl ? '1' : '0' ?>"
         onclick="ouvrirFermer(this)">

        <h3><?= $u['pseudo'] ?></h3>
        <div class="user-badges">
            <?php if ($admin): ?><span class="badge badge--rating">Admin</span><?php endif; ?>
            <?php if ($bl):    ?><span class="badge badge--danger">Blacklisté</span><?php endif; ?>
        </div>

        <div class="body hidden mt-md" onclick="event.stopPropagation()">
            <span class="badge badge--rating"><?= $u['nb_matchs_vus'] ?> matchs vus</span>
            <span class="badge badge--rating"><?= $u['nb_leagues'] ?> leagues</span>
            <div class="action-btns mt-md"></div>
        </div>

    </div>
    <?php endforeach; ?>

</div>

<script>
function afficherMessage(msg, ok) {
    var m = document.getElementById('message');
    m.textContent = msg;
    m.className = ok ? 'badge badge--success' : 'badge badge--danger';
    m.style.display = 'block';
    setTimeout(function() { m.style.display = 'none'; }, 2500);
}

function toutFermer() {
    document.querySelectorAll('.body').forEach(function(p) { p.classList.add('hidden'); });
}

function ouvrirFermer(carte) {
    var corps = carte.querySelector('.body');
    var ouvert = !corps.classList.contains('hidden');
    toutFermer();
    if (!ouvert) {
        corps.classList.remove('hidden');
        afficherBoutons(carte);
    }
}

function afficherBoutons(carte) {
    var admin  = carte.dataset.admin === '1';
    var bl     = carte.dataset.bl === '1';
    var id     = carte.dataset.id;
    var pseudo = carte.querySelector('h3').textContent.trim();
    var zone   = carte.querySelector('.action-btns');
    zone.innerHTML = '';

    var btnBl = document.createElement('button');
    if (bl) {
        btnBl.className = 'btn btn--success';
        btnBl.textContent = 'Autoriser';
        btnBl.onclick = function() {
            if (confirm('Autoriser ' + pseudo + ' ?')) modifierUtilisateur('Autoriser', id, carte);
        };
    } else {
        btnBl.className = 'btn btn--danger';
        btnBl.textContent = 'Blacklister';
        btnBl.disabled = admin;
        if (!admin) btnBl.onclick = function() {
            if (confirm('Blacklister ' + pseudo + ' ?')) modifierUtilisateur('Interdire', id, carte);
        };
    }
    zone.appendChild(btnBl);

    var btnAdmin = document.createElement('button');
    if (admin) {
        btnAdmin.className = 'btn btn--outline';
        btnAdmin.textContent = 'Rétrograder';
        btnAdmin.onclick = function() {
            if (confirm('Rétrograder ' + pseudo + ' ?')) modifierUtilisateur('Retrograder', id, carte);
        };
    } else {
        btnAdmin.className = 'btn btn--primary';
        btnAdmin.textContent = 'Promouvoir';
        btnAdmin.disabled = bl;
        if (!bl) btnAdmin.onclick = function() {
            if (confirm('Promouvoir ' + pseudo + ' ?')) modifierUtilisateur('Promouvoir', id, carte);
        };
    }
    zone.appendChild(btnAdmin);

    if (!admin) {
        var btnSuppr = document.createElement('button');
        btnSuppr.className = 'btn btn--danger mt-sm';
        btnSuppr.textContent = 'Supprimer';
        btnSuppr.onclick = function() {
            if (confirm('Supprimer ' + pseudo + ' définitivement ?')) modifierUtilisateur('Supprimer', id, carte);
        };
        zone.appendChild(btnSuppr);
    }
}

function modifierUtilisateur(action, id, carte) {
    var data = new FormData();
    data.append('action', action);
    data.append('idUser', id);

    fetch('controleur.php', { method: 'POST', body: data, headers: { 'X-Requested-With': 'XMLHttpRequest' } })
    .then(function(r) { return r.json(); })
    .then(function(res) {
        afficherMessage(res.msg, res.ok);
        if (!res.ok) return;

        if (action === 'Supprimer') { carte.remove(); return; }

        if (action === 'Interdire')   carte.dataset.bl    = '1';
        if (action === 'Autoriser')   carte.dataset.bl    = '0';
        if (action === 'Promouvoir')  carte.dataset.admin = '1';
        if (action === 'Retrograder') carte.dataset.admin = '0';

        var badges = carte.querySelector('.user-badges');
        badges.innerHTML = '';
        if (carte.dataset.admin === '1') badges.innerHTML += '<span class="badge badge--rating">Admin</span>';
        if (carte.dataset.bl    === '1') badges.innerHTML += '<span class="badge badge--danger">Blacklisté</span>';

        afficherBoutons(carte);
        toutFermer();
    });
}

function filtrerUsers(val) {
    val = val.toLowerCase();
    document.querySelectorAll('[data-pseudo]').forEach(function(carte) {
        carte.style.display = carte.dataset.pseudo.includes(val) ? '' : 'none';
    });
}
</script>
