<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
    <title>UOB Student Nationality Data</title>
</head>
<body>
<style>
  h1 {
    --pico-font-family: Pacifico, cursive;
    --pico-font-weight: 400;
    --pico-typography-spacing-vertical: 0.5rem;
  }
  table
  {
    box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px, rgba(10, 37, 64, 0.35) 0px -2px 6px 0px inset;

  }
</style>
    <main class="container">
        <h1 style="text-align:center;">UOB Student Nationality Data</h1>
        <?php
        $URL = "https://data.gov.bh/api/explore/v2.1/catalog/datasets/01-statistics-of-students-nationalities_updated/records?where=colleges%20like%20%22IT%22%20AND%20the_programs%20like%20%22bachelor%22&limit=100";
        $response = file_get_contents($URL);

        if ($response === false) {
            //echo error
            echo "<p>Failed to retrieve data.</p>";
        } else {
            // decode the response
            $result = json_decode($response, true);

            // Check if the 'results' array exists and contains data
            if (isset($result["results"]) && !empty($result["results"])) {
                 ?>
                 <div class="overflow-auto">
                <table class="striped">
                 <thead data-theme=dark>
                    <?php
                    echo    "<tr>
                            <th>#</th>
                            <th>Year</th>
                            <th>Semester</th>
                            <th>Program</th>
                            <th>Nationality</th>
                            <th>College</th>
                            <th>Number of Students</th>
                        </tr>
                      </thead>";
                echo "<tbody>";

                // Loop through the 'results' array and display the records
                $counter = 1;
                foreach ($result["results"] as $record) {
                    echo "<tr>
                            <td>{$counter}</td>
                            <td>" . htmlspecialchars($record["year"] ?? "N/A") . "</td>
                            <td>" . htmlspecialchars($record["semester"] ?? "N/A") . "</td>
                            <td>" . htmlspecialchars($record["the_programs"] ?? "N/A") . "</td>
                            <td>" . htmlspecialchars($record["nationality"] ?? "N/A") . "</td>
                            <td>" . htmlspecialchars($record["colleges"] ?? "N/A") . "</td>
                            <td>" . htmlspecialchars($record["number_of_students"] ?? "N/A") . "</td>
                          </tr>";
                    $counter++;
                }

                echo "</tbody>";
                echo "</table>";
                
            } else {
                echo "<p>No records found in the API response.</p>";
            }
        }
        
        // check the format and testing
        //print_r($result);
        //print_r($record);
        ?>
        </div>
    </main>
</body>
</html>
