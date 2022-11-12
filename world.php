<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

/* Sanitizing the input from the user. */
$country = filter_input(INPUT_GET, 'country', FILTER_SANITIZE_STRING);
$context = filter_input(INPUT_GET, "context", FILTER_SANITIZE_STRING);

/* Selecting all the countries from the database where the name is like the country variable. */
$stmt = $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%' ");
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

/* Selecting the name, district, and population of the cities from the cities table and joining it with
the countries table on the country code. It is then selecting the countries where the name is like
the country variable. */
$city_info= $conn->query("SELECT cities.name, cities.district, cities.population
FROM cities LEFT JOIN countries ON countries.code = cities.country_code
WHERE countries.name LIKE '%$country%'");

/* Fetching all the results from the query and putting them into an associative array. */
$city= $city_info->fetchAll(PDO::FETCH_ASSOC);
?>


<?php if(isset($country)&&(!isset($context))):?>
  <table id="resultsTable">
    <thead>
      <tr>
        <th>Country Name</th>
        <th>Continent</th>
        <th>Day of Independence</th>
        <th>Head of State</th>
      </tr>
    </thead>

    <tbody>
      <?php
      foreach($results as $countryRecord){
        ?>
          <tr>
            <td> <?= $countryRecord['name']; ?></td>
            <td> <?= $countryRecord['continent']; ?></td>
            <td> <?= $countryRecord['independence_year']; ?></td>
            <td> <?= $countryRecord['head_of_state']; ?></td>
          </tr>
        <?php
      }
      ?>
    </tbody>
  </table>
  <?php endif; ?>


<?php if (isset($context)):?>
  <table id="resultsTable">
    <thead>
      <tr>
        <th>City</th>
        <th>District</th>
        <th>Population</th>
      </tr>
    </thead>

    <tbody>
      <?php
      foreach($city as $cityRecord){
        ?>
          <tr>
            <td> <?= $cityRecord['name']; ?></td>
            <td> <?= $cityRecord['district']; ?></td>
            <td> <?= $cityRecord['population']; ?></td>
          </tr>
        <?php
      }
      ?>
    </tbody>
  </table>
<?php endif ?>





