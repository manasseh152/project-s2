<?php

/**
 * Checks if the current environment is development.
 *
 * @return bool True if the environment is development, false otherwise.
 */
function isDev(): bool
{
  $appEnv = $_ENV['APP_ENV'];

  if ($appEnv === 'development') {
    return true;
  }
  return false;
}

/**
 * Gets the contents of the manifest file.
 *
 * @return array An associative array representing the contents of the manifest file.
 */
function getManifest(): array
{
  $content = file_get_contents(__DIR__ . '/../../public/dist/manifest.json');
  return json_decode($content, true);
}

/**
 * Returns the URL of an asset file.
 *
 * @param string $entry The name of the asset entry in the manifest file.
 * @return string The URL of the asset file.
 */
function assetUrl(string $entry): string
{
  $manifest = getManifest();
  return isset($manifest[$entry])
    ? '/dist/' . $manifest[$entry]['file']
    : '';
}

/**
 * Returns the URLs of all the import files associated with a given entry in the manifest file.
 *
 * @param string $entry The name of the entry in the manifest file.
 * @return array An array of URLs of the import files.
 */
function importsUrls(string $entry): array
{
  $urls = [];
  $manifest = getManifest();

  if (!empty($manifest[$entry]['imports'])) {
    foreach ($manifest[$entry]['imports'] as $imports) {
      $urls[] = '/dist/' . $manifest[$imports]['file'];
    }
  }
  return $urls;
}

/**
 * Returns the URL of a JavaScript file.
 *
 * @param string $entry The name of the entry in the manifest file.
 * @return string The URL of the JavaScript file.
 */
function jsUrl(string $entry): string
{
  $url = isDev($entry)
    ? $_ENV['VITE_HOST'] . '/' . $entry
    : assetUrl($entry);

  if (!$url) {
    return '';
  }
  return $url;
}

/**
 * Returns the URLs of all the CSS files associated with a given entry in the manifest file.
 *
 * @param string $entry The name of the entry in the manifest file. Defaults to 'ts/main.css'.
 * @return array An array of URLs of the CSS files.
 */
function cssUrls(string $entry): array
{
  $urls = [];
  $manifest = getManifest();

  if (!empty($manifest[$entry])) {
    $urls[] = '/dist/' . $manifest[$entry]['file'];
  }

  return $urls;
}
