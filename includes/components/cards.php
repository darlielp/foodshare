<div class="cards">

    <div class="card">
        <div class="icon-bg"><i class="fa-solid fa-box"></i></div>
        <h3><?= $totalDoacoes ?? 0 ?></h3>
        <p>Doações Totais</p>
    </div>

    <div class="card">
        <div class="icon-bg">
            <i class="fa-solid fa-box-open"></i>
        </div>
        <h3><?= $doacoesDisponiveis ?? 0 ?></h3>
        <p>Doações Disponíveis</p>
    </div>

    <div class="card">
        <div class="icon-bg"><i class="fa-solid fa-arrow-trend-up"></i></div>
        <h3><?= $doacoesSolicitadas ?? 0 ?></h3>
        <p>Doações Solicitadas</p>
    </div>

    <div class="card">
        <div class="icon-bg"><i class="fa-solid fa-check"></i></div>
        <h3><?= $doacoesConcluidas ?? 0 ?></h3>
        <p>Doações Concluídas</p>
    </div>

    <div class="card">
        <div class="icon-bg"><i class="fa-solid fa-xmark"></i></div>
        <h3><?= $doacoesCanceladas ?? 0 ?></h3>
        <p>Doações Canceladas</p>
    </div>

    <div class="card">
        <div class="icon-bg"><i class="fa-solid fa-location-dot"></i></div>
        <h3><?= $locais ?? 0 ?></h3>
        <p>Locais Registrados</p>
    </div>

    <div class="card">
        <div class="icon-bg"><i class="fa-solid fa-weight-hanging"></i></div>
        <h3><?= ($totalKg ?? 0) ?> kg</h3>
        <p>Total de alimentos salvos</p>
    </div>

    <div class="card">
        <div class="icon-bg"><i class="fa-solid fa-users"></i></div>
        <h3><?= $usuarios ?? 0 ?></h3>
        <p>Usuários Cadastrados</p>
    </div>

</div>