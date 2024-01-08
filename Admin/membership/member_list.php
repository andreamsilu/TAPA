<?php
// Database connection
include "../news/navigation.php";
include "../../forms/connection.php";
?>

<div class="container mt-4">
  <h2>User Information</h2>
  <?php
  // Fetch all user information
  $sql = "SELECT * FROM users";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
      // Display user information in a striped table
      echo "<table class='table table-striped'>";
      echo "<thead class='thead-dark'><tr><th>ID</th><th>Fullname</th><th>Email</th><th>Phone</th></tr></thead>";
      echo "<tbody>";
      while ($row = $result->fetch_assoc()) {
          echo "<tr>";
          echo "<td><a href='view_member.php?id=" . $row['id'] . "'>" . $row['id'] . "</a></td>";
          echo "<td>" . $row['fullname'] . "</td>";
          echo "<td>" . $row['email'] . "</td>";
          echo "<td>" . $row['phone'] . "</td>";

          echo "</tr>";
      }
      echo "</tbody>";
      echo "</table>";
  } else {
      echo "<p>No users found.</p>";
  }

  // Close database connection
  $conn->close();
  ?>
</div>

<? include "footer.php"; ?>
