<?php

$script = 'loadstring(game:HttpGet("https://raw.githubusercontent.com/EdgeIY/infiniteyield/master/source"))()';
$scriptLength = strlen($script) + 1; // Include null terminator
$header = str_repeat("\0", 16);
$header = substr_replace($header, pack('V', $scriptLength), 8, 4); // Write the length to the header

$socket = stream_socket_client('tcp://127.0.0.1:5553', $errno, $errstr, 3);
if ($socket) {
    fwrite($socket, $header . $script . "\0");
    fclose($socket);
    echo "F9 in Roblox to see script activity.\n";
} else {
    echo "Connection error: $errstr\n";
}
