
    <!-- Modal content -->
    <div id="editModal" class="modal-content">
        <div class="modal-header">
            <span class="close" id="close-editModal">&times;</span>
            <h2>Edit Movie</h2>
        </div>
        <div class="modal-body">
            <form action="javascript:void(0)" method="POST" onsubmit="update_movie(this)" id="edit-movie-form">
                <div>
                    <input type="hidden" name="e_id" id="e_id" placeholder="ID" readonly>
                    <label for="name" >Name</label>
                    <input type="text" name="e_name" id="e_name" placeholder="Enter movie name">
                </div>
                <div>
                    <label for="genre">Genre</label>
                    <input type="text" name="e_genre" id="e_genre" placeholder="Enter movie genre">
                </div>
                <div class="col float-right">
                    <button type="submit" class="btn-dark mt-1 mb-1">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

