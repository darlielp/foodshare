<form class="filtros" id="filtroForm" method="GET" action="doacoes.php">

    <input 
        type="text" 
        name="busca"
        id="busca"
        placeholder="Procurar doações..." 
        class="input-busca"
        value="<?= htmlspecialchars($_GET['busca'] ?? '') ?>"
    >

    <select name="categoria" id="filtroCategoria" onchange="this.form.submit()">
        <option value="">Todas categorias</option>
        <option value="vegetais" <?= ($_GET['categoria'] ?? '') == 'vegetais' ? 'selected' : '' ?>>Vegetais</option>
        <option value="padaria" <?= ($_GET['categoria'] ?? '') == 'padaria' ? 'selected' : '' ?>>Padaria</option>
        <option value="laticinios" <?= ($_GET['categoria'] ?? '') == 'laticinios' ? 'selected' : '' ?>>Laticínios</option>
        <option value="enlatados" <?= ($_GET['categoria'] ?? '') == 'enlatados' ? 'selected' : '' ?>>Enlatados</option>
    </select>

    <select name="status" id="filtroStatus" onchange="this.form.submit()">
        <option value="">Todos status</option>
        <option value="disponivel" <?= ($_GET['status'] ?? '') == 'disponivel' ? 'selected' : '' ?>>Disponível</option>
        <option value="solicitado" <?= ($_GET['status'] ?? '') == 'solicitado' ? 'selected' : '' ?>>Solicitado</option>
        <option value="concluido" <?= ($_GET['status'] ?? '') == 'concluido' ? 'selected' : '' ?>>Concluído</option>
    </select>
</form>