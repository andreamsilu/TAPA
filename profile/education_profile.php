<!-- <!DOCTYPE html> -->
<!-- <html lang="en"> -->

<head>
    
    <!-- Include Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Style for the form (initially hidden) */
        #EducationForm {
            display: none;
        }

        #container {
            box-shadow: 10px 20px 30px blue;

        }
    </style>
</head>


    <div class="container mt-0 p-3">
        <row class="justify-content-center">
            <div class="card text-center w-80">
                <div class="card-header">
                    <i class="fa-solid fa-graduation-cap" style="color: #1e4d9f; text-align:left;"></i>Education
                </div>
                <div class="card-body">
                    <!-- "Add" button with onclick event to show the form -->
                    <button class="btn btn-primary" onclick="showEducationForm()">Add</button>

                    <!-- Education and Awards Form (Initially hidden) -->
                    <!-- Education Form -->
                    <form id="EducationForm" action="education/education.php" method="post">
                        <!-- Close button to close the form -->
                        <button type="button" class="close" aria-label="Close" onclick="closeEducationForm()">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <hr style="border: 2px solid #15A9E5; margin: 20px 0;">
                        <br>
                        <div class="form-group">
                            <label for="qualificationCategory">Education Category</label>
                            <select class="form-control" name="qualificationCategory" id="qualificationCategory">
                            <option value="Psychology">Psychology</option>
                                <option value="Accounting - H011, H411">Accounting - H011, H411</option>
                                <option value="Accounting and Business Administration">Accounting and Business Administration</option>
                                <!-- Add more options here -->
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="level">Education Level</label>
                            <input type="text" class="form-control" name="level" id="level">
                        </div>
                        
                        <div class="form-group">
                            <label for="institution">University/Institution</label>
                            <input type="text" class="form-control"  name="institution" id="institution">
                        </div>
                       
                        <div class="form-group">
                            <label for="currentlyStudyingAt">Completion Year</label>
                            <input type="year" class="form-control" name="currentlyStudyingAt" id="currentlyStudyingAt">
                        </div>
                        <!-- Cancel button to cancel and close the form -->
                        <button type="button" class="btn btn-secondary" onclick="closeEducationForm()">Cancel</button>
                        <!-- Submit button to submit the form -->
                        <button type="submit" class="btn btn-success">Submit</button>
                    </form>

                    <style>
                        /* CSS styles to align labels to the left (start) of form fields */
                        form {
                            display: flex;
                            flex-direction: column;
                        }

                        .form-group {
                            display: flex;
                            flex-direction: column;
                            margin-bottom: 10px;
                        }
                        label {
                            margin-bottom: 5px;
                            text-align: left;
                        }
                        .form-control {
                            width: 100%;
                        }
                    </style>
                </div>
            </div>
        </row>
    </div>

    <!-- Include Bootstrap JS and jQuery (optional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        // Function to show the Education form
        function showEducationForm() {
            document.getElementById("EducationForm").style.display = "block";
        }

        // Function to close the Education form
        function closeEducationForm() {
            document.getElementById("EducationForm").style.display = "none";
        }
    </script>


