<?php

  // Session cookie parameters
  session_name('CUSTOM_SESSID');     // Custom name
  session_set_cookie_params([
    'lifetime' => 3600,              // Cookie expiration time
    'path'     => '/',               // Available across the entire domain
    'domain'   => '',                // Current domain (leave empty for security)
    'secure'   => false,             // Only send cookie over HTTPS if true
    'httponly' => true,              // Prevent JavaScript access (security)
    'samesite' => 'Lax'              // Prevent CSRF attacks (Set to 'Strict' to avoid GET access from other websites)
  ]);

  // Cookie parameters
  define("COOKIE_LIFETIME", 3600);
  define("COOKIE_PATH", "/");
  define("COOKIE_DOMAIN", "");
  
?>
