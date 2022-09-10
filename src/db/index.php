<?php

//Connect to DB
require_once "pdo_ini.php";

// Unique first letters
$sth = $pdo->query("SELECT DISTINCT LEFT(name, 1) AS letter FROM airports ORDER BY letter");
$sth->setFetchMode(\PDO::FETCH_ASSOC);
$uniqueFirstLetters = $sth->fetchAll();

// Filtering
$filterByLetter = isset($_GET['filter_by_first_letter']) ? " WHERE LEFT(airports.name, 1) = '$_GET[filter_by_first_letter]' " : '';

$filterByState = $joinForQuery = '';

if (isset($_GET['filter_by_state'])) {
    $filterByState = empty($filterByLetter) ? " WHERE " : " AND ";
    $filterByState .= "states.name = '$_GET[filter_by_state]' ";
    $joinForQuery = " LEFT JOIN states ON states.id = airports.state_id ";
}

// Sorting
$sortParamsFromDB = [
    'name' => 'airports.name',
    'code' => 'airports.code',
    'state' => 'states.name',
    'city' => 'cities.name',
];

$sortBy = isset($_GET['sort']) ? " ORDER BY " . $sortParamsFromDB[$_GET['sort']] : '';

// Pagination
$page = $_GET['page'] ?? 1;
$perPage = 10;

$sql = 'SELECT COUNT(*) AS id FROM airports ' . $joinForQuery . $filterByLetter . $filterByState;
$sth = $pdo->query($sql);
$airportsCount = $sth->fetchAll();
$page_count = ceil($airportsCount[0]['id'] / $perPage);

// Get airports from DB with all filters / sorting / pagination
$pagination = " LIMIT $perPage OFFSET " . ($page - 1) * $perPage;

$sql = 'SELECT airports.name, airports.code, states.name AS state_name, cities.name AS city_name, airports.address, airports.timezone
FROM airports 
LEFT JOIN cities ON cities.id = airports.city_id
LEFT JOIN states ON states.id = airports.state_id ' . $filterByLetter . $filterByState . $sortBy . $pagination;

$sth = $pdo->query($sql);
$sth->setFetchMode(\PDO::FETCH_ASSOC);
$airports = $sth->fetchAll();

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>Airports</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>
<main role="main" class="container">

    <h1 class="mt-5">US Airports</h1>

    <!--
        Filtering task #1
        Replace # in HREF attribute so that link follows to the same page with the filter_by_first_letter key
        i.e. /?filter_by_first_letter=A or /?filter_by_first_letter=B

        Make sure, that the logic below also works:
         - when you apply filter_by_first_letter the page should be equal 1
         - when you apply filter_by_first_letter, than filter_by_state (see Filtering task #2) is not reset
           i.e. if you have filter_by_state set you can additionally use filter_by_first_letter
    -->

    <?php
    $letterHref = [];
    if (isset($_GET['filter_by_state'])) {
        $letterHref['filter_by_state'] = $_GET['filter_by_state'];
    }
    ?>

    <div class="alert alert-dark">
        Filter by first letter:

        <?php foreach ($uniqueFirstLetters as $letter): ?>
            <a href="?<?= http_build_query(["filter_by_first_letter" => $letter['letter'], ...$letterHref]) ?>"><?= $letter['letter'] ?></a>
        <?php endforeach; ?>

        <a href="/src/db" class="float-right">Reset all filters</a>
    </div>

    <!--
        Sorting task
        Replace # in HREF so that link follows to the same page with the sort key with the proper sorting value
        i.e. /?sort=name or /?sort=code etc

        Make sure, that the logic below also works:
         - when you apply sorting pagination and filtering are not reset
           i.e. if you already have /?page=2&filter_by_first_letter=A after applying sorting the url should looks like
           /?page=2&filter_by_first_letter=A&sort=name
    -->
    <?php
    $sortHref = [];
    if (isset($_GET['filter_by_first_letter'])) {
        $sortHref['filter_by_first_letter'] = $_GET['filter_by_first_letter'];
    }
    if (isset($_GET['page'])) {
        $sortHref['page'] = $_GET['page'];
    }
    ?>

    <table class="table">
        <thead>
        <tr>
            <th scope="col"><a href="?<?= http_build_query(['sort' => 'name', ...$sortHref]) ?>">Name</a></th>
            <th scope="col"><a href="?<?= http_build_query(['sort' => 'code', ...$sortHref]) ?>">Code</a></th>
            <th scope="col"><a href="?<?= http_build_query(['sort' => 'state', ...$sortHref]) ?>">State</a></th>
            <th scope="col"><a href="?<?= http_build_query(['sort' => 'city', ...$sortHref]) ?>">City</a></th>
            <th scope="col">Address</th>
            <th scope="col">Timezone</th>
        </tr>
        </thead>
        <tbody>
        <!--
            Filtering task #2
            Replace # in HREF so that link follows to the same page with the filter_by_state key
            i.e. /?filter_by_state=A or /?filter_by_state=B

            Make sure, that the logic below also works:
             - when you apply filter_by_state the page should be equal 1
             - when you apply filter_by_state, than filter_by_first_letter (see Filtering task #1) is not reset
               i.e. if you have filter_by_first_letter set you can additionally use filter_by_state
        -->
        <?php
        $stateHref = [];

        if (isset($_GET['filter_by_first_letter'])) {
            $stateHref['filter_by_first_letter'] = $_GET['filter_by_first_letter'];
        }
        ?>

        <?php foreach ($airports as $airport): ?>
        <tr>
            <td><?= $airport['name'] ?></td>
            <td><?= $airport['code'] ?></td>
            <td><a href="?<?= http_build_query(['filter_by_state' => $airport['state_name'], ...$stateHref])?>"><?= $airport['state_name'] ?></a></td>
            <td><?= $airport['city_name'] ?></td>
            <td><?= $airport['address'] ?></td>
            <td><?= $airport['timezone'] ?></td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <!--
        Pagination task
        Replace HTML below so that it shows real pages dependently on number of airports after all filters applied

        Make sure, that the logic below also works:
         - show 5 airports per page
         - use page key (i.e. /?page=1)
         - when you apply pagination - all filters and sorting are not reset
    -->
    <?php

    $pageHref = [];

    if (isset($_GET['filter_by_first_letter'])) {
        $pageHref['filter_by_first_letter'] = $_GET['filter_by_first_letter'];
    }

    if (isset($_GET['state'])) {
        $pageHref['state'] = $_GET['state'];
    }

    if (isset($_GET['sort'])) {
        $pageHref['sort'] = $_GET['sort'];
    }
    ?>

    <nav aria-label="Navigation">
        <ul class="pagination justify-content-center">
            <?php for ($page = 1; $page <= $page_count; $page++): ?>
                <li class="page-item"><a class="page-link" href="?<?= http_build_query(['page' => $page, ...$pageHref]) ?>"><?= $page; ?></a></li>
            <?php endfor; ?>
        </ul>
    </nav>

</main>
</html>
