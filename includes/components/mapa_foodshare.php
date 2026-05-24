<div class="mapa-container">

    <!-- MAPA -->
    <div id="map"></div>

    <!-- INFO BOX -->
    <div class="map-overlay">

        <!-- DOADORES -->
        <div class="map-info-card">

            <div class="info-dot doador"></div>

            <div>
                <strong>Doações Disponíveis</strong>

                <p>
                    <?= $totalDoadores ?> locais
                </p>
            </div>

        </div>

        <!-- RECEPTORES -->
        <div class="map-info-card">

            <div class="info-dot receptor"></div>

            <div>
                <strong>Receptores Disponíveis</strong>

                <p>
                    <?= $totalReceptores ?> locais
                </p>
            </div>

        </div>

    </div>

</div>