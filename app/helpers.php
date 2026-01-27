<?php

if (!function_exists('productImage')) {
    function productImage($path) {
        // Check if file exists in storage
        $storagePath = storage_path('app/public/' . $path);
        if (file_exists($storagePath)) {
            // Read file and convert to base64
            $imageData = base64_encode(file_get_contents($storagePath));
            $extension = pathinfo($path, PATHINFO_EXTENSION);
            $mimeType = $extension === 'png' ? 'image/png' : 'image/jpeg';
            return 'data:' . $mimeType . ';base64,' . $imageData;
        }
        
        // Fallback
        return 'https://via.placeholder.com/400x533/c2185b/ffffff?text=Product';
    }
}