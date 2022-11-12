<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

/* Sanitizing the input from the user. */
$country = filter_input(INPUT_GET, 'country', FILTER_SANITIZE_STRING);

/* Selecting all the countries from the database where the name is like the country variable. */
$stmt = $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%' ");


$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<body>
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
  
</body>