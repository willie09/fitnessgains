<?php
/**
 * Diagnostic script to check if Vite build assets exist and are accessible.
 * Upload this to your Hostinger public/ folder and visit:
 * https://fitnessgains.site/check_assets.php
 */

$buildDir = __DIR__ . '/build';
$manifestPath = $buildDir . '/manifest.json';

echo "<h1>Hostinger Asset Diagnostic</h1>";
echo "<pre>";

// 1. Check if public/hot exists (DEV mode trap)
$hotPath = __DIR__ . '/hot';
echo "1. public/hot exists: " . (file_exists($hotPath) ? "YES (BAD - delete this!)" : "NO (good)") . "\n\n";

// 2. Check build directory
echo "2. Build directory exists: " . (is_dir($buildDir) ? "YES" : "NO") . "\n";
echo "   Path: $buildDir\n\n";

// 3. Check manifest
echo "3. manifest.json exists: " . (file_exists($manifestPath) ? "YES" : "NO") . "\n";
if (file_exists($manifestPath)) {
    $manifest = json_decode(file_get_contents($manifestPath), true);
    echo "   Content:\n";
    print_r($manifest);

    // 4. Check each asset file
    echo "\n4. Checking asset files:\n";
    foreach ($manifest as $key => $entry) {
        if (isset($entry['file'])) {
            $filePath = $buildDir . '/' . $entry['file'];
            $exists = file_exists($filePath);
            $size = $exists ? filesize($filePath) : 0;
            echo "   - {$entry['file']}: " . ($exists ? "EXISTS ($size bytes)" : "MISSING!") . "\n";
        }
    }
}

echo "\n5. Document root: " . $_SERVER['DOCUMENT_ROOT'] . "\n";
echo "6. Script path: " . __FILE__ . "\n";
echo "7. Current dir: " . __DIR__ . "\n";

echo "\n6. Trying direct URL test...\n";
$baseUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'];
$testUrl = $baseUrl . '/build/assets/app-ZWK0dAmG.css';
echo "   URL: $testUrl\n";

$ch = curl_init($testUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo "   HTTP Status: $httpCode\n";
echo "   Response length: " . strlen($response) . " bytes\n";
if ($httpCode == 200 && strlen($response) > 0) {
    echo "   First 200 chars:\n" . htmlspecialchars(substr($response, 0, 200)) . "\n";
}

echo "</pre>";

echo "<hr><h2>Quick Fixes</h2>";
echo "<ul>";
echo "<li>If <b>public/hot exists</b>: Delete it via File Manager or SSH: <code>rm public/hot</code></li>";
echo "<li>If <b>build directory is missing</b>: Upload the entire <code>public/build/</code> folder from your local machine.</li>";
echo "<li>If <b>manifest.json exists but assets are missing</b>: Re-run <code>npm run build</code> locally and re-upload <code>public/build/</code>.</li>";
echo "<li>If <b>HTTP 404 on direct URL</b>: Your web server document root may be wrong, or .htaccess is blocking access.</li>";
echo "</ul>";

