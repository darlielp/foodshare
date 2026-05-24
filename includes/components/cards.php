<div class="cards">

    <div class="card">
        <i class="fa-solid fa-box"></i>
        <h3><?= $totalDoacoes ?? 0 ?></h3>
        <p>Doações Totais</p>
    </div>

    <div class="card">
        <i class="fa-solid fa-box-open"></i>
        <h3><?= $doacoesDisponiveis ?? 0 ?></h3>
        <p>Doações Disponíveis</p>
    </div>

    <div class="card">
        <i class="fa-solid fa-arrow-trend-up"></i>
        <h3><?= $doacoesSolicitadas ?? 0 ?></h3>
        <p>Doações Solicitadas</p>
    </div>

    <div class="card">
        <i class="fa-solid fa-check"></i>
        <h3><?= $doacoesConcluidas ?? 0 ?></h3>
        <p>Doações Concluídas</p>
    </div>

    <div class="card">
        <i class="fa-solid fa-xmark"></i>
        <h3><?= $doacoesCanceladas ?? 0 ?></h3>
        <p>Doações Canceladas</p>
    </div>

    <div class="card">
        <i class="fa-solid fa-location-dot"></i>
        <h3><?= $locais ?? 0 ?></h3>
        <p>Locais Registrados</p>
    </div>

    <div class="card">
        <i class="fa-solid fa-weight-hanging"></i>
        <h3><?= ($totalKg ?? 0) ?> kg</h3>
        <p>Total de alimentos salvos</p>
    </div>

    <div class="card">
        <i class="fa-solid fa-users"></i>
        <h3><?= $usuarios ?? 0 ?></h3>
        <p>Usuários Cadastrados</p>
    </div>

</div>