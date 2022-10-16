    <!-- Modal content -->
    <div id="deleteModal" class="modal-content">
        <div class="modal-header">
            <span class="close" onclick="close_deleteModal()">&times;</span>
            <h2>Delete Movie</h2>
        </div>
        <div class="modal-body">
            <div class="text-center mt-1">
                <span>Are you sure you want to delete <span id="movieNameDelete"></span>?</span>
            </div>
            <div class="col float-right">
                <button type="button" class="btn-dark mt-2 mb-1 mr-1" onclick="close_deleteModal()">Cancel</button>
                <button type="submit" class="btn-outline mt-2 mb-1" id="delete_movie">Delete</button>
            </div>
        </div>
    </div>