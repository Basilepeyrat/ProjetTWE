<?php
if (basename($_SERVER["PHP_SELF"]) != "index.php") {
    header("Location:../index.php?view=scores");
    die("");
}
securiserAdmin("login");

$idMatch = valider("idMatch");
$isAjax  = isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
           strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';

if ($idMatch && $isAjax) {
    $m = getMatchById($idMatch);
    if (!$m) { echo "<p class='text-muted'>Match introuvable</p>"; exit; }
    ?>

    <form id="form-score">
        <input type="hidden" name="idMatch" value="<?= $m['id'] ?>" />

        <p class="text-muted"><strong>Score</strong></p>
        <div class="match-card__score">
            <div>
                <input id="inp-score-dom" type="number" name="score_dom"
                       min="0" max="99" value="<?= $m['score_dom'] ?? '' ?>" placeholder="0" />
                <div class="text-muted"><?= htmlspecialchars($m['equipe_dom']) ?></div>
            </div>
            <div class="match-card__value text-muted">–</div>
            <div>
                <input id="inp-score-ext" type="number" name="score_ext"
                       min="0" max="99" value="<?= $m['score_ext'] ?? '' ?>" placeholder="0" />
                <div class="text-muted"><?= htmlspecialchars($m['equipe_ext']) ?></div>
            </div>
        </div>

        <p class="text-muted mt-md"><strong>⚽ Buteurs</strong></p>
        <input type="text" id="filtre-but" placeholder="Tapez pour filtrer..."
               oninput="filtrerSelect('filtre-but','sel-but')" />
        <div style="display:flex;gap:8px;">
            <select id="sel-but" size="5">
                <option value="">Sélectionner…</option>
                <?php foreach ($m['joueurs'] as $j): ?>
                    <option value="<?= $j['id'] ?>">
                        <?= htmlspecialchars($j['prenom'].' '.$j['nom']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <button type="button" id="btn-but" class="btn btn--primary" style="width:auto;">+</button>
        </div>
        <div id="tags-buteurs" class="mt-sm"></div>

        <p class="text-muted mt-md"><strong>Passeurs décisifs</strong></p>
        <input type="text" id="filtre-pas" placeholder="Tapez pour filtrer..."
               oninput="filtrerSelect('filtre-pas','sel-pas')" />
        <div style="display:flex;gap:8px;">
            <select id="sel-pas" size="5">
                <option value="">Sélectionner…</option>
                <?php foreach ($m['joueurs'] as $j): ?>
                    <option value="<?= $j['id'] ?>">
                        <?= htmlspecialchars($j['prenom'].' '.$j['nom']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <button type="button" id="btn-pas" class="btn btn--primary" style="width:auto;">+</button>
        </div>
        <div id="tags-passeurs" class="mt-sm"></div>

        <p class="text-muted mt-md"><strong>Homme du match FIFA</strong></p>
        <?php if ($m['mvpfifa_id'] > 0 && $m['hdm_nom']): ?>
            <p>
                <span class="badge badge--success">✓ <?= htmlspecialchars($m['hdm_nom']) ?></span>
                <?php if ($m['score_dom'] !== null): ?>
                    <span class="badge badge--rating">
                        <?= $m['score_dom'] ?> - <?= $m['score_ext'] ?>
                    </span>
                <?php endif; ?>
            </p>
        <?php endif; ?>
        <input type="text" id="filtre-hdm" placeholder="Tapez pour filtrer..."
               oninput="filtrerSelect('filtre-hdm','sel-hdm')" />
        <select name="idJoueur" id="sel-hdm" size="5">
            <?php foreach ($m['joueurs'] as $j): ?>
                <option value="<?= $j['id'] ?>"
                        <?= ($j['id'] == $m['mvpfifa_id']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($j['prenom'].' '.$j['nom']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <button type="submit" class="btn btn--success mt-md">💾 Enregistrer</button>
    </form>

    <?php
    exit;
}

// ── Page normale ──────────────────────────────────────────────────────────────

$tousLesMatchs = listerMatchsTroisJours();

$hier       = date('Y-m-d', strtotime('-1 day'));
$aujourdhui = date('Y-m-d');
$demain     = date('Y-m-d', strtotime('+1 day'));

$colonnes = [
    'Hier'        => [],
    "Aujourd'hui" => [],
    'Demain'      => [],
];

foreach ($tousLesMatchs as $match) {
    $date = date('Y-m-d', strtotime($match['date_match']));
    if ($date === $hier)           $colonnes['Hier'][]        = $match;
    elseif ($date === $aujourdhui) $colonnes["Aujourd'hui"][] = $match;
    elseif ($date === $demain)     $colonnes['Demain'][]      = $match;
}
?>

<div class="top-bar">
    <h1>⚙️ Scores — Admin</h1>
    <p>Cliquez sur un match pour modifier son score, ses buteurs et son HDM</p>
</div>

<div class="container">

    <div id="toast"></div>

    <div class="dashboard-matchs">
    <?php foreach ($colonnes as $titre => $matchs): ?>
        <div class="colonne-matchs">
            <h2><?= $titre ?></h2>
            <?php if (empty($matchs)): ?>
                <p class="text-muted">Aucun match</p>
            <?php else: ?>
                <?php foreach ($matchs as $m):
                    $scoreSet = ($m['score_dom'] !== null && $m['score_ext'] !== null);
                    $score    = $scoreSet ? $m['score_dom'].' - '.$m['score_ext'] : '? - ?';
                ?>
                    <div class="card match-card"
                         data-id="<?= $m['id'] ?>"
                         onclick="togglePanneau(this, <?= $m['id'] ?>)">
                        <div class="match-card__score">
                            <div class="match-card__team"><?= htmlspecialchars($m['equipe_dom']) ?></div>
                            <div class="match-card__value">
                                <span class="badge <?= $scoreSet ? 'badge--success' : 'badge--rating' ?>">
                                    <?= $score ?>
                                </span>
                            </div>
                            <div class="match-card__team"><?= htmlspecialchars($m['equipe_ext']) ?></div>
                        </div>
                        <div class="match-card__date">
                            <?= date('H:i', strtotime($m['date_match'])) ?>
                        </div>
                    </div>
                    <div class="card panneau" id="panneau-<?= $m['id'] ?>"
                         style="display:none;border-top:2px solid var(--color-primary-light);"
                         onclick="event.stopPropagation()">
                        <p class="text-muted">Chargement…</p>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
    </div>

</div>

<script>
var buteurs      = {};
var passeurs     = {};
var panneauOuvert = null;

function showToast(msg, ok) {
    var t = document.getElementById('toast');
    t.textContent = msg;
    t.className = ok ? 'toast toast--success' : 'toast toast--danger';
    t.style.display = 'block';
    setTimeout(function() { t.style.display = 'none'; }, 2500);
}

function fermerPanneau() {
    if (panneauOuvert) {
        panneauOuvert.style.display = 'none';
        panneauOuvert = null;
    }
    buteurs  = {};
    passeurs = {};
}

function togglePanneau(carte, idMatch) {
    var panneau = document.getElementById('panneau-' + idMatch);

    if (panneau.style.display !== 'none') {
        fermerPanneau();
        return;
    }

    fermerPanneau();

    panneau.style.display = 'block';
    panneau.innerHTML = '<p class="text-muted">Chargement…</p>';
    panneauOuvert = panneau;

    fetch('index.php?view=scores&idMatch=' + idMatch, {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(function(r) { return r.text(); })
    .then(function(html) {
        panneau.innerHTML = html;
        bindForms(idMatch);
        panneau.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    });
}

function ajouterTag(type, idJoueur, nomJoueur) {
    var store = type === 'but' ? buteurs : passeurs;
    if (store[idJoueur]) store[idJoueur].nb++;
    else store[idJoueur] = { nom: nomJoueur, nb: 1 };
    rafraichirTags(type);
}

function retirerTag(type, idJoueur) {
    var store = type === 'but' ? buteurs : passeurs;
    delete store[idJoueur];
    rafraichirTags(type);
}

function rafraichirTags(type) {
    var store  = type === 'but' ? buteurs : passeurs;
    var contId = type === 'but' ? 'tags-buteurs' : 'tags-passeurs';
    var cont   = document.getElementById(contId);
    if (!cont) return;
    cont.innerHTML = '';
    Object.keys(store).forEach(function(id) {
        var item = store[id];
        var tag  = document.createElement('span');
        tag.className = 'badge badge--rating';
        tag.innerHTML = item.nom + (item.nb > 1 ? ' &times;'+item.nb : '') +
            ' <button type="button" onclick="retirerTag(\''+type+'\',\''+id+'\')">×</button>';
        cont.appendChild(tag);
    });
}

function bindForms(idMatch) {
    buteurs  = {};
    passeurs = {};

    var btnBut = document.getElementById('btn-but');
    if (btnBut) {
        btnBut.addEventListener('click', function(e) {
            e.stopPropagation();
            var sel = document.getElementById('sel-but');
            if (!sel.value) return;
            ajouterTag('but', sel.value, sel.options[sel.selectedIndex].text);
        });
    }

    var btnPas = document.getElementById('btn-pas');
    if (btnPas) {
        btnPas.addEventListener('click', function(e) {
            e.stopPropagation();
            var sel = document.getElementById('sel-pas');
            if (!sel.value) return;
            ajouterTag('passe', sel.value, sel.options[sel.selectedIndex].text);
        });
    }

    var formScore = document.getElementById('form-score');
    if (formScore) {
        formScore.addEventListener('submit', function(e) {
            e.preventDefault();
            e.stopPropagation();
            var scoreDom  = parseInt(document.getElementById('inp-score-dom').value) || 0;
            var scoreExt  = parseInt(document.getElementById('inp-score-ext').value) || 0;
            var nbButs    = Object.values(buteurs).reduce(function(s,b){ return s+b.nb; }, 0);
            var totalButs = scoreDom + scoreExt;

            if (nbButs > 0 && nbButs !== totalButs) {
                if (!confirm('Le nombre de buteurs ('+nbButs+') ne correspond pas au score total ('+totalButs+'). Continuer quand même ?'))
                    return;
            }

            var data = new FormData();
            data.append('action', 'Maj score');
            data.append('idMatch', idMatch);
            data.append('score_dom', scoreDom);
            data.append('score_ext', scoreExt);

            Object.keys(buteurs).forEach(function(id) {
                for (var i = 0; i < buteurs[id].nb; i++)
                    data.append('buteurs[]', id);
            });
            Object.keys(passeurs).forEach(function(id) {
                for (var i = 0; i < passeurs[id].nb; i++)
                    data.append('passeurs[]', id);
            });

			envoyer(data, function(res) {
				if (res.ok) {
					window.location.href = 'index.php?view=scores';
				} else {
					showToast(res.msg, false);
				}
			});
        });
    }
}

function envoyer(data, callback) {
    fetch('controleur.php', {
        method: 'POST',
        body: data,
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(function(r) { return r.json(); })
    .then(callback);
}

function filtrerSelect(inputId, selectId) {
    var filtre = document.getElementById(inputId).value.toLowerCase();
    var options = document.getElementById(selectId).options;
    for (var i = 0; i < options.length; i++) {
        var texte = options[i].text.toLowerCase();
        options[i].style.display = texte.includes(filtre) ? '' : 'none';
    }
}
</script>
