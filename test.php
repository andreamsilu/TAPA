<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>Awards, Certificates & Qualifications</title>
</head>
<body>
  <div class="container mt-5">
    <div class="card">
      <div class="card-body text-center">
        <h5 class="card-title">Awards, Certificates & Qualifications</h5>
        <button class="btn btn-primary" data-toggle="modal" data-target="#certificateModal">Add</button>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="certificateModal" tabindex="-1" role="dialog" aria-labelledby="certificateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="certificateModalLabel">Add Award, Certificate or Qualification</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- Your form for Awards, Certificates & Qualifications goes here -->
          <form>
            <div class="form-group">
              <label for="certificateTitle">Title</label>
              <input type="text" class="form-control" id="certificateTitle" placeholder="Title">
            </div>
            <div class="form-group">
              <label for="certificateCategory">Certificate Category</label>
              <select class="form-control" id="certificateCategory">
                <option value="Certified Human Resource Manager">Certified Human Resource Manager</option>
                <option value="Certified Internal Auditor">Certified Internal Auditor</option>
                <option value="Certified Public Accountant / NBAA">Certified Public Accountant / NBAA</option>
                <option value="IT & Network Systems">IT & Network Systems</option>
                <option value="Other">Other</option>
                <option value="Procurement and Supplies Professionals and Technicians Board">Procurement and Supplies Professionals and Technicians Board</option>
              </select>
            </div>
            <div class="form-group">
              <label for="countryOfInstitution">Country Of Institution</label>
              <select class="form-control" id="countryOfInstitution">
                <option value="Select">Select</option>
                <!-- Add more country options here -->
              </select>
            </div>
            <div class="form-group">
              <label for="institution">Institution</label>
              <input type="text" class="form-control" id="institution" placeholder="Institution">
            </div>
            <div class="form-group">
              <label for="completionDate">Completion Date</label>
              <input type="date" class="form-control" id="completionDate">
            </div>
            <div class="form-check">
              <input type="checkbox" class="form-check-input" id="currentlyOngoing">
              <label class="form-check-label" for="currentlyOngoing">Currently On-going</label>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save</button>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>
