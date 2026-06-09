<?php
// Simple and safe PHP IP logger
// Creates (or appends to) ip_log.txt in the same directory.

// Get visitor IP in a safe way
function getVisitorIP() {
    // Check common headers used by proxies/CDNs
    $keys = [
        'HTTP_CLIENT_IP',
        'HTTP_X_FORWARDED_FOR',
        'REMOTE_ADDR'
    ];

    foreach ($keys as $key) {
        if (!empty($_SERVER[$key])) {
            // X_FORWARDED_FOR can contain multiple IPs -> take first
            $ipList = explode(',', $_SERVER[$key]);
            $ip = trim($ipList[0]);

            // Validate IP
            if (filter_var($ip, FILTER_VALIDATE_IP)) {
                return $ip;
            }
        }
    }

    return 'UNKNOWN';
}

// Sanitize User-Agent
function getUserAgent() {
    if (!isset($_SERVER['HTTP_USER_AGENT'])) {
        return 'UNKNOWN';
    }
    // Remove control characters/unsafe chars
    return preg_replace('/[^a-zA-Z0-9 .()\/;:_-]/', '', $_SERVER['HTTP_USER_AGENT']);
}

$ip        = getVisitorIP();
$userAgent = getUserAgent();
$time      = date('Y-m-d H:i:s');
$line      = "$time | IP: $ip | UA: $userAgent\n";

$logFile = __DIR__ . '/ip_log.txt';

// Write with file lock to prevent race conditions
try {
    $fh = fopen($logFile, 'a');
    if ($fh === false) {
        throw new Exception("Could not open log file.");
    }
    if (flock($fh, LOCK_EX)) {
        fwrite($fh, $line);
        fflush($fh);
        flock($fh, LOCK_UN);
    }
    fclose($fh);
} catch (Exception $e) {
    // In production you would log this error internally, not show it
    error_log("IP logger error: " . $e->getMessage());
}

// Optional: user feedback
echo "Visit recorded.";
?>
