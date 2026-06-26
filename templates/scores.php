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
    $rs = getMatchById($idMatch);
    if (!$rs) { echo "<p class='text-muted'>Match introuvable</p>"; exit; }
    $m = $rs[0];
    $m['joueurs']    = listerJoueursMatch($idMatch);
    $m['mvpfifa_id'] = SQLGetChamp("SELECT mvpfifa_id FROM MATCHS WHERE id='$idMatch'");
    $m['hdm_nom']    = SQLGetChamp("SELECT CONCAT(J.prenom, ' ', J.nom) FROM MATCHS M JOIN JOUEUR J ON J.id = M.mvpfifa_id WHERE M.id='$idMatch'");
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

        <div class="form-group mt-md">
            <label>Buteurs</label>
            <input type="text" id="filtre-but" placeholder="Tapez pour filtrer..."
                   oninput="filtrerSelect('filtre-but','sel-but')" />
            <select id="sel-but" size="5">
                <option value="">Sélectionner...</option>
                <?php foreach ($m['joueurs'] as $j): ?>
                    <option value="<?= $j['id'] ?>">
                        <?= htmlspecialchars($j['prenom'].' '.$j['nom']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <button type="button" id="btn-but" class="btn btn--primary mt-sm">Ajouter buteur</button>
            <div id="liste-buteurs" class="mt-sm"></div>
        </div>

        <div class="form-group">
            <label>Passeurs decisifs</label>
            <input type="text" id="filtre-pas" placeholder="Tapez pour filtrer..."
                   oninput="filtrerSelect('filtre-pas','sel-pas')" />
            <select id="sel-pas" size="5">
                <option value="">Sélectionner...</option>
                <?php foreach ($m['joueurs'] as $j): ?>
                    <option value="<?= $j['id'] ?>">
                        <?= htmlspecialchars($j['prenom'].' '.$j['nom']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <button type="button" id="btn-pas" class="btn btn--primary mt-sm">Ajouter passeur</button>
            <div id="liste-passeurs" class="mt-sm"></div>
        </div>

        <div class="form-group">
            <label>Homme du match FIFA</label>
            <?php if ($m['mvpfifa_id'] > 0 && $m['hdm_nom']): ?>
                <p><span class="badge badge--success">Actuellement : <?= htmlspecialchars($m['hdm_nom']) ?></span></p>
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
        </div>

        <button type="submit" class="btn btn--success">Enregistrer</button>
    </form>

    <?php
    exit;
}

$tousLesMatchs = listerTousLesMatchs();
?>

<div class="top-bar">
    <h1>Scores</h1>
    <p>Cliquez sur un match pour modifier</p>
</div>

<div class="container">

    <div id="message" class="mt-sm"></div>

    <?php
    // affichage de TOUS les matchs, groupés par date (comme l'accueil)
    $aujourdhui   = date('Y-m-d');
    $dateCourante = null;
    foreach ($tousLesMatchs as $m):
        $jour = date('Y-m-d', strtotime($m['date_match']));
        if ($jour !== $dateCourante):
            $dateCourante  = $jour;
            $estAujourdhui = ($jour === $aujourdhui);
    ?>
        <h2 <?= $estAujourdhui ? 'id="aujourdhui"' : '' ?>>
            <?= $estAujourdhui ? "Aujourd'hui" : date('d/m/Y', strtotime($jour)) ?>
        </h2>
    <?php endif; ?>

        <?php
        $scoreSet = ($m['score_dom'] !== null && $m['score_ext'] !== null);
        $score    = $scoreSet ? $m['score_dom'].' - '.$m['score_ext'] : '? - ?';
        ?>
        <div class="card match-card"
             data-nom="<?= htmlspecialchars(strtolower($m['equipe_dom'].' '.$m['equipe_ext'])) ?>"
             onclick="ouvrirFermer(this, <?= $m['id'] ?>)">
            <div class="match-card__score">
                <div class="match-card__team"><?= htmlspecialchars($m['equipe_dom']) ?></div>
                <div class="match-card__value">
                    <span class="badge <?= $scoreSet ? 'badge--success' : 'badge--rating' ?>">
                        <?= $score ?>
                    </span>
                </div>
                <div class="match-card__team"><?= htmlspecialchars($m['equipe_ext']) ?></div>
            </div>
            <div class="match-card__date"><?= date('H:i', strtotime($m['date_match'])) ?></div>
        </div>
        <div class="card panneau" id="panneau-<?= $m['id'] ?>"
             style="display:none;"
             onclick="event.stopPropagation()">
            <p class="text-muted">Chargement...</p>
        </div>

    <?php endforeach; ?>

    <?php if (count($tousLesMatchs) == 0): ?>
        <p class="text-muted">Aucun match.</p>
    <?php endif; ?>

</div>

<script>
var buteurs  = {};
var passeurs = {};
var panneauOuvert = null;

function afficherMessage(msg, ok) {
    var m = document.getElementById('message');
    m.textContent = msg;
    m.className = ok ? 'badge badge--success' : 'badge badge--danger';
    m.style.display = 'block';
    setTimeout(function() { m.style.display = 'none'; }, 2500);
}

function fermerPanneau() {
    if (panneauOuvert) {
        panneauOuvert.style.display = 'none';
        panneauOuvert = null;
    }
    buteurs  = {};
    passeurs = {};
}

function ouvrirFermer(carte, idMatch) {
    var panneau = document.getElementById('panneau-' + idMatch);
    if (panneau.style.display !== 'none') {
        fermerPanneau();
        return;
    }
    fermerPanneau();
    panneau.style.display = 'block';
    panneau.innerHTML = '<p class="text-muted">Chargement...</p>';
    panneauOuvert = panneau;
    fetch('index.php?view=scores&idMatch=' + idMatch, {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(function(r) { return r.text(); })
    .then(function(html) {
        panneau.innerHTML = html;
        initialiserFormulaire(idMatch);
        panneau.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    });
}

function ajouterJoueur(type, id, nom) {
    var liste = type === 'but' ? buteurs : passeurs;
    if (liste[id]) liste[id].nb++;
    else liste[id] = { nom: nom, nb: 1 };
    rafraichirListe(type);
}

function retirerJoueur(type, id) {
    var liste = type === 'but' ? buteurs : passeurs;
    delete liste[id];
    rafraichirListe(type);
}

function rafraichirListe(type) {
    var liste  = type === 'but' ? buteurs : passeurs;
    var zoneId = type === 'but' ? 'liste-buteurs' : 'liste-passeurs';
    var zone   = document.getElementById(zoneId);
    if (!zone) return;
    zone.innerHTML = '';
    Object.keys(liste).forEach(function(id) {
        var item = liste[id];
        var tag  = document.createElement('span');
        tag.className = 'badge badge--rating';
        tag.innerHTML = item.nom + (item.nb > 1 ? ' x'+item.nb : '') +
            ' <button type="button" onclick="retirerJoueur(\''+type+'\',\''+id+'\')">x</button>';
        zone.appendChild(tag);
    });
}

function initialiserFormulaire(idMatch) {
    buteurs  = {};
    passeurs = {};

    var btnBut = document.getElementById('btn-but');
    if (btnBut) {
        btnBut.addEventListener('click', function(e) {
            e.stopPropagation();
            var sel = document.getElementById('sel-but');
            if (!sel.value) return;
            ajouterJoueur('but', sel.value, sel.options[sel.selectedIndex].text);
        });
    }

    var btnPas = document.getElementById('btn-pas');
    if (btnPas) {
        btnPas.addEventListener('click', function(e) {
            e.stopPropagation();
            var sel = document.getElementById('sel-pas');
            if (!sel.value) return;
            ajouterJoueur('passe', sel.value, sel.options[sel.selectedIndex].text);
        });
    }

    var form = document.getElementById('form-score');
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            e.stopPropagation();
            var scoreDom = parseInt(document.getElementById('inp-score-dom').value) || 0;
            var scoreExt = parseInt(document.getElementById('inp-score-ext').value) || 0;
            var nbButs   = Object.values(buteurs).reduce(function(s,b){ return s+b.nb; }, 0);
            var total    = scoreDom + scoreExt;

            if (nbButs > 0 && nbButs !== total) {
                if (!confirm('Le nombre de buteurs ('+nbButs+') ne correspond pas au score ('+total+'). Continuer ?'))
                    return;
            }

  
            var dataScore = new FormData();
            dataScore.append('action', 'Maj score');
            dataScore.append('idMatch', idMatch);
            dataScore.append('score_dom', scoreDom);
            dataScore.append('score_ext', scoreExt);
            envoyer(dataScore, function() {});

    
            Object.keys(buteurs).forEach(function(id) {
                for (var i = 0; i < buteurs[id].nb; i++) {
                    var dataBut = new FormData();
                    dataBut.append('action', 'Ajouter but');
                    dataBut.append('idMatch', idMatch);
                    dataBut.append('idJoueur', id);
                    envoyer(dataBut, function() {});
                }
            });

 
            Object.keys(passeurs).forEach(function(id) {
                for (var i = 0; i < passeurs[id].nb; i++) {
                    var dataPas = new FormData();
                    dataPas.append('action', 'Ajouter passe');
                    dataPas.append('idMatch', idMatch);
                    dataPas.append('idJoueur', id);
                    envoyer(dataPas, function() {});
                }
            });

        
            var selHdm = document.getElementById('sel-hdm');
            if (selHdm && selHdm.value) {
                var dataHdm = new FormData();
                dataHdm.append('action', 'Maj hdm');
                dataHdm.append('idMatch', idMatch);
                dataHdm.append('idJoueur', selHdm.value);
                envoyer(dataHdm, function() {});
            }

            setTimeout(function() {
                window.location.href = 'index.php?view=scores';
            }, 500);
        });
    }
}

function envoyer(data, retour) {
    fetch('controleur.php', {
        method: 'POST',
        body: data,
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(function(r) { return r.json(); })
    .then(retour);
}

function filtrerSelect(inputId, selectId) {
    var filtre = document.getElementById(inputId).value.toLowerCase();
    var options = document.getElementById(selectId).options;
    for (var i = 0; i < options.length; i++) {
        options[i].style.display = options[i].text.toLowerCase().includes(filtre) ? '' : 'none';
    }
}
</script>
