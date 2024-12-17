<?php
function genSlug($pdo, $table, $column, $string) {
    $slug = strtolower(trim($string));
    $slug = preg_replace('/[^a-z0-9-]+/', '-', $slug);
    $slug = preg_replace('/-+/', '-', $slug);
    $slug = trim($slug, '-');

    $originalSlug = $slug;
    $counter = 1;

    while (checkSlug($pdo, $table, $column, $slug)) {
        $slug = $originalSlug . '-' . $counter;
        $counter++;
    }

    return $slug;
}

function checkSlug($pdo, $table, $column, $slug) {
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM {$table} WHERE {$column} = :slug");
    $stmt->execute([':slug' => $slug]);
    return $stmt->fetchColumn() > 0;
}
