<div class="container mt-5">
    <div class="container mt-5">
        <div class="container mt-5">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title"><i class="bi bi-graduation-cap"></i> Education</h5>
                    <button class="btn btn-primary" id="openModalButton">ADD</button>
                    <button class="btn btn-gradient" id="openModalButton">Edit</button>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal" id="educationModal" tabindex="-1" role="dialog" aria-labelledby="educationModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="educationModalLabel"> <i class="bi bi-graduation-cap"></i>Add Education Information</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Your education information form goes here -->
                        <div class="container mt-5">
                            <form>
                                <div class="form-group">
                                    <label for="courseTitle"><span> <i class="fas fa-graduation-cap"></i></span> Title</label>
                                    <input type="text" class="form-control" id="courseTitle" placeholder="E.g. BSc in Engineering">
                                </div>
                                <div class="form-group">
                                    <label for="qualificationCategory">Qualification Category</label>
                                    <select class="form-control" id="qualificationCategory">
                                        <option value="Accounting - H011, H411">Accounting - H011, H411</option>
                                        <option value="Accounting and Business Administration">Accounting and Business Administration</option>
                                        <!-- Add more options here -->
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="level">Level</label>
                                    <input type="text" class="form-control" id="level">
                                </div>
                                <div class="form-group">
                                    <label for="countryOfInstitution">Country of Institution</label>
                                    <input type="text" class="form-control" id="countryOfInstitution">
                                </div>
                                <div class="form-group">
                                    <label for="institution">Institution</label>
                                    <input type="text" class="form-control" id="institution">
                                </div>
                                <div class="form-group">
                                    <label for="startDate">Start Date</label>
                                    <input type="date" class="form-control" id="startDate">
                                </div>
                                <div class="form-group">
                                    <label for="endDate">End Date</label>
                                    <input type="date" class="form-control" id="endDate">
                                </div>
                                <div class="form-group">
                                    <label for="currentlyStudyingAt">Currently Studying At</label>
                                    <input type="text" class="form-control" id="currentlyStudyingAt">
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
</div>