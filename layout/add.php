    <div class="col mt-2">
        <button class="btn-dark" type="button" id="show-addModal">Add Movie</button>
    </div>
    
    <!-- Modal content -->
    <div id="addModal" class="modal-content">
        <div class="modal-header">
            <span class="close" id="close-addModal">&times;</span>
            <h2>Add Movie</h2>
        </div>
        <div class="modal-body">
            <form action="javascript:void(0)" method="POST" onsubmit="add_movie(this)" id="add-movie-form">
                <div>
                    <label for="name" >Name</label>
                    <input type="text" name="name" id="name" placeholder="Enter movie name">
                </div>
                
                <div>
                    <label for="genre">Genre</label>
                    <input type="text" name="genre" id="genre" placeholder="Enter movie genre">
                </div>
                
                <div class="col float-right">
                    <button type="submit" class="btn-dark mt-1 mb-1">Add</button>
                </div>
            </form>
        </div>
    </div>

