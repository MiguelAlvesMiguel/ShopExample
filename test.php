<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Tables</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 30px;
        }
        th, td {
            border: 1px solid #000;
            padding: 5px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <?php
    include 'dbConnection.php';
    include 'createTables.php'; // Creates tables if they don't exist

    //createTables($conn);

    $tables = [
        "Types", "Users", "Category", "Preferences", "Products",
        "Favorites", "Notifications", "Chats", "Messages", "Transactions",
        "PreferenceBrands", "PreferenceSizes", "PreferenceCategories", "PreferenceTypes"
    ];

    foreach ($tables as $table) {
        echo "<h2>$table</h2>";
        $result = $conn->query("SELECT * FROM $table");
        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr>";
            while ($column = $result->fetch_field()) {
                echo "<th>" . $column->name . "</th>";
            }
            echo "</tr>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                foreach ($row as $value) {
                    echo "<td>" . htmlspecialchars($value) . "</td>";
                }
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No data in the table.</p>";
        }
    }

    $conn->close();
    ?>
</body>
</html>
