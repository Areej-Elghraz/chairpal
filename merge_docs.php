<?php
// PHP script to strip comments from Documentation.jsonc and merge Markdown docs

// 1. Combine Markdown docs
$files = ['auth', 'profile', 'orgs', 'categories', 'places'];
$mdContent = "# ChairPal API Documentation\n\n";

foreach ($files as $file) {
    if (file_exists(__DIR__ . "/docs_{$file}.md")) {
        $mdContent .= file_get_contents(__DIR__ . "/docs_{$file}.md") . "\n\n";
    }
}
file_put_contents(__DIR__ . "/Documentation.md", $mdContent);

// 2. Clean up jsonc file to be valid JSON
if (file_exists(__DIR__ . "/Documentation.jsonc")) {
    $content = file_get_contents(__DIR__ . "/Documentation.jsonc");
    // Strip single line comments starting with //
    $content = preg_replace('#^\s*//.+$#m', '', $content);
    // Decode and encode to ensure JSON validity
    $json = json_decode($content, true);
    if ($json !== null) {
        file_put_contents(__DIR__ . "/Documentation.jsonc", json_encode($json, JSON_PRETTY_PRINT));
        echo "Successfully cleaned Documentation.jsonc and generated Documentation.md\n";
    } else {
        echo "Failed to parse jsonc content. Ensure manual comments are removed correctly.\n";
        echo json_last_error_msg();
    }
} else {
    echo "Documentation.jsonc not found.\n";
}
