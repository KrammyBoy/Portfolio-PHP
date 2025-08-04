<div class="certificates">
    <div class="image-container wave curve">
        <h1>Certificates</h1>
    </div>
    <div class="certificate-container">
        <?php foreach($certificates as $certificate): ?>
        <div class="certificate-card">
            <div class="cert-header">
                <div class="cert-info">
                    <h2 class="cert-name"><?= htmlspecialchars($certificate['name'])?></h2>
                    <p class="cert-issuer"><?= htmlspecialchars($certificate['issuer'])?></p>
                </div>
            </div>    
            <p class="cert-description"><?= htmlspecialchars($certificate['description'])?></p>

            <div class="cert-footer">
                <?php 
                    $date_earned = new DateTime($certificate['date_earned']);
                ?>
                <span class="cert-date"><?= htmlspecialchars($date_earned->format('M d Y'))?></span>
                <?php

                $asset_path = 'assets/certificates/';
                $href = htmlspecialchars($certificate['credential_url']) . '.pdf';
                // Check if type is a File
                if($certificate['type'] === "File"){
                    $href = $asset_path . basename($href);
                    // Ensure the file exists
                    if (!file_exists($href)) {
                        $href = '#'; // Fallback if file does not exist
                        throw new \Exception('File not found: ' . $href);
                    }
                }
                ?>
                <a href="<?= htmlspecialchars($href)?>" class="cert-action"
                    <?= ($certificate['type'] === "File")? htmlspecialchars('download'): htmlspecialchars('target="_blank"') ?>
                >
                    <i class="bx <?= ($certificate['type'] === "File") ? htmlspecialchars('bx-download'):htmlspecialchars('bx-link-external')?>">
                        <?= ($certificate['type'] === "File") ? htmlspecialchars('Download'): htmlspecialchars('View Certificate') ?>
                    </i>
                </a>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>