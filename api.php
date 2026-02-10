<?php
// api.php - Backend API handler
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');

// Replace these with your actual API credentials
define('API_BASE_URL', 'YOUR_API_BASE_URL');
define('API_KEY', 'YOUR_API_KEY');
define('API_TOKEN', 'YOUR_API_TOKEN');

// Your API functions here (paste your provided PHP code)
function makeApiRequest($endpoint) {  
    $url = API_BASE_URL . $endpoint;  
  
    error_log("Making API request to: " . $url);  
  
    $ch = curl_init();  
  
    curl_setopt($ch, CURLOPT_URL, $url);  
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);  
    curl_setopt($ch, CURLOPT_USERAGENT, 'okhttp/4.8.0');  
    curl_setopt($ch, CURLOPT_ENCODING, 'gzip');  
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  
  
    $response = curl_exec($ch);  
  
    if (curl_errno($ch)) {  
        error_log('cURL Error: ' . curl_error($ch));  
        curl_close($ch);  
        return null;  
    }  
  
    curl_close($ch);  
  
    $data = json_decode($response, true);  
  
    if (json_last_error() !== JSON_ERROR_NONE) {  
        error_log('JSON Error: ' . json_last_error_msg());  
        return null;  
    }  
  
    return $data;  
}  

function getFeaturedContent() {  
    $content = getCategoryContent('rating', null, 1);  
    return $content && !empty($content) ? $content[0] : null;  
}  

function getSeriesByCategory($categoryLabel, $classificationFilter = null, $limit = 10) {  
    $endpoint = "/serie/by/filtres/0/created/2/" . API_KEY . "/" . API_TOKEN . "/";  
    $data = makeApiRequest($endpoint);  
  
    if (!$data || !is_array($data)) {  
        return [];  
    }  
  
    $filteredSeries = array_filter($data, function($item) use ($categoryLabel, $classificationFilter) {  
        $hasCategory = false;  
        if (isset($item['genres']) && is_array($item['genres'])) {  
            foreach ($item['genres'] as $genre) {  
                if (isset($genre['title']) && $genre['title'] === $categoryLabel) {  
                    $hasCategory = true;  
                    break;  
                }  
            }  
        }  
  
        $hasClassification = true;  
        if ($classificationFilter && isset($item['classification'])) {  
            $hasClassification = strpos($item['classification'], $classificationFilter) !== false;  
        }  
  
        return $hasCategory && $hasClassification;  
    });  
  
    $filteredSeries = array_values($filteredSeries);  
    return array_slice($filteredSeries, 0, $limit);  
}  

function getRamadanSeries($limit = 10) {  
    return getSeriesByCategory('مسلسلات رمضان 2025', 'مصر', $limit);  
}  

function getCategoryContent($sort = 'created', $type = null, $limit = 20) {  
    $typeParam = $type ?: 'serie';  
    $endpoint = "/{$typeParam}/by/filtres/0/{$sort}/1/" . API_KEY . "/" . API_TOKEN . "/";  
  
    $data = makeApiRequest($endpoint);  
  
    if (!$data || !is_array($data)) {  
        return [];  
    }  
  
    if ($type) {  
        $data = array_filter($data, function($item) use ($type) {  
            return isset($item['type']) && $item['type'] === $type;  
        });  
        $data = array_values($data);  
    }  
  
    return array_slice($data, 0, $limit);  
}  

function searchContent($query) {  
    $encodedQuery = rawurlencode($query);  
    $endpoint = "/search/{$encodedQuery}/0/" . API_KEY . "/" . API_TOKEN . "/";  
    return makeApiRequest($endpoint);  
}  

function getMovieDetails($id) {  
    $endpoint = "/movie/by/{$id}/" . API_KEY . "/" . API_TOKEN . "/";  
    $movie = makeApiRequest($endpoint);  
  
    if ($movie) {  
        return $movie;  
    }  
  
    $movies = getCategoryContent('created', 'movie', 50);  
  
    foreach ($movies as $movie) {  
        if ($movie['id'] == $id) {  
            return $movie;  
        }  
    }  
  
    return null;  
}  

function getMovieSources($id) {  
    $endpoint = "/movie/source/by/{$id}/" . API_KEY . "/" . API_TOKEN . "/";  
    return makeApiRequest($endpoint);  
}  

function getSeriesDetails($id) {  
    $endpoint = "/serie/by/{$id}/" . API_KEY . "/" . API_TOKEN . "/";  
    $series = makeApiRequest($endpoint);  
  
    if ($series && !empty($series['title'])) {  
        return $series;  
    }  
  
    $allSeries = getCategoryContent('created', 'serie', 100);  
  
    foreach ($allSeries as $seriesItem) {  
        if ($seriesItem['id'] == $id) {  
            return $seriesItem;  
        }  
    }  
  
    return [  
        'id' => $id,  
        'title' => "Series #{$id}",  
        'description' => "Details not available",  
        'image' => '/placeholder.svg',  
        'type' => 'serie'  
    ];  
}  

function getSeriesSeasons($id) {  
    $endpoint = "/season/by/serie/{$id}/" . API_KEY . "/" . API_TOKEN . "/";  
    return makeApiRequest($endpoint) ?: [];  
}  

function getEpisodeDetails($id) {  
    $endpoint = "/episode/by/{$id}/" . API_KEY . "/" . API_TOKEN . "/";  
    return makeApiRequest($endpoint);  
}  

function getEpisodeSources($id) {  
    $endpoint = "/episode/source/by/{$id}/" . API_KEY . "/" . API_TOKEN . "/";  
    return makeApiRequest($endpoint);  
}

// Handle requests
$action = isset($_GET['action']) ? $_GET['action'] : '';
$response = [];

try {
    switch ($action) {
        case 'featured':
            $response = getCategoryContent('rating', null, 8);
            break;

        case 'ramadan':
            $response = getRamadanSeries(10);
            break;

        case 'movies':
            $sort = isset($_GET['sort']) ? $_GET['sort'] : 'rating';
            $response = getCategoryContent($sort, 'movie', 20);
            break;

        case 'series':
            $sort = isset($_GET['sort']) ? $_GET['sort'] : 'rating';
            $response = getCategoryContent($sort, 'serie', 20);
            break;

        case 'search':
            $query = isset($_GET['q']) ? $_GET['q'] : '';
            if (!empty($query)) {
                $response = searchContent($query);
            }
            break;

        default:
            $response = ['error' => 'Invalid action'];
    }

    echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()], JSON_UNESCAPED_UNICODE);
}
?>
