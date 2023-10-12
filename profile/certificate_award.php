<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certification&Award</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Style for the form (initially hidden) */
        #certificationForm {
            display: none;
        }
    </style>
</head>

<body>
    <div class="container mt-0 w-80 p-3">
        <div class="card text-center">
            <div class="card-header">
                <i class="fa-solid fa-certificate"></i> Certification&Awards
            </div>
            <div class="card-body">
                <!-- "Add" button with onclick event to show the form -->
                <button class="btn btn-primary" onclick="showCertificationForm()">Add</button>

                <!-- Certification and Awards Form (Initially hidden) -->
                <form id="certificationForm" action="forms/certificate.php" method="POST">
                    <!-- Your form fields here -->

                    <button type="button" class="close" aria-label="Close" onclick="closeCertificationForm()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="form-group">
                        <label for="title">Certification Title:</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Enter title" required>
                    </div>
                    <div class="form-group">
                        <label for="certificateCategory">Certificate Category:</label>
                        <select class="form-control" id="certificateCategory" name="certificateCategory" required>
                            <option value="">--Select--</option>
                            <option value="children psychologist">Certified psychologist for children</option>
                            <!-- Add more options here -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="institution">Institution:</label>
                        <input type="text" class="form-control" id="institution" name="institution" placeholder="Enter institution" required>
                    </div>
                    <div class="form-group">
                        <label for="completionDate">Completion Date:</label>
                        <input type="date" class="form-control" id="completionDate" name="completionDate" required>
                    </div>
                    <div class="form-group">
                        <label for="certificationLink">Certification Link</label>
                        <input type="text" class="form-control" id="certificationLink" name="certificationLink" placeholder="Enter certification link" required>
                    </div>
                    <div class="form-group">
                        <label for="certification_copy">Upload Certification</label>
                        <input type="file" class="form-control" id="certification_copy" name="certification_copy" placeholder="Upload certificate copy" required>
                    </div>
                    <!-- Cancel button to cancel and close the form -->
                    <button type="button" class="btn btn-secondary" onclick="closeCertificationForm()">Cancel</button>
                    <!-- Submit button to submit the form -->
                    <button type="submit" class="btn btn-success">Submit</button>
                </form>

            </div>
        </div>
    </div>

    <!-- Include Bootstrap JS and jQuery (optional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        // Function to show the certification form
        function showCertificationForm() {
            document.getElementById("certificationForm").style.display = "block";
        }

        // Function to close the certification form
        function closeCertificationForm() {
            document.getElementById("certificationForm").style.display = "none";
        }
    </script>
</body>

</html>