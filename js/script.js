    
    let html = "";
    const alert = document.getElementById('alert');
    const error_message = document.getElementById('error_message');


    function close_error(){
        alert.style.display = "none"; 
    }

    

    let http = new XMLHttpRequest();

    class HTTPRequest{

        constructor(url, method, params){
            this.url = url;
            this.method = method;
            this.params = params;
        }

        header(){
            http.open(this.method, this.url, true);
            http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        }

        footer(){
            http.send(this.params);
        }

        fetch() {

            this.header();
            http.onreadystatechange = function() {
                if (http.readyState == 4 && http.status == 200) {

                    let result = JSON.parse(http.responseText);
                    html = '';

                    html+= `<table class="mb-5">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Genre</th>
                                    <th>Action</th>
                                </tr>`;
                
                    if(result){
                        result.reverse().forEach(data => {
                            html+= '<tr>'+
                                        '<td>'+data.id+'</td>'+
                                        '<td>'+data.name+'</td>'+
                                        '<td>'+data.genre+'</td>'+
                                        '<td>'+
                                            '<button id="'+data.id+'" name="'+data.name+'" genre="'+data.genre+'" class="btn-outline mr-1" onclick="show_editModal(this)" type="button">Edit</button>'+
                                            '<button id="'+data.id+'" name="'+data.name+'" class="btn-outline" onclick="show_deleteModal(this)" type="button">Delete</button>'+
                                        '</td>'+
                                    '</tr>';
                        });
                    }else{
                        html+= '<tr><td colspan="4" class="p-2 text-center">No data found.</td></tr>';
                    }
            
                    html+= `</table>`;
                    document.getElementById('display_movie').innerHTML = html;

                    
                }
            }
            this.footer();

        }

        add(){

            this.header();

            http.onreadystatechange = function() {
                if (http.readyState == 4 && http.status == 200) {
                    let result = JSON.parse(http.responseText);
                    if(result.success === true){
                        document.getElementById('add-movie-form').reset();
                        alert.style.backgroundColor = "rgb(4, 170, 109)";
                        error_message.innerText = result.messages;
                        alert.style.display = "block";
                        addModal.style.display = "none";
                        fetch_movie();
                    }else{
                        alert.style.backgroundColor = "rgb(244, 67, 54)";
                        error_message.innerText = result.messages;
                        alert.style.display = "block"; 
                    }
                }
            }

            this.footer();

        }


        update(){

            this.header();

            http.onreadystatechange = function() {
                if (http.readyState == 4 && http.status == 200) {
                    let result = JSON.parse(http.responseText);
                    if(result.success === true){
                        document.getElementById('edit-movie-form').reset();
                        alert.style.backgroundColor = "rgb(4, 170, 109)";
                        error_message.innerText = result.messages;
                        alert.style.display = "block";
                        editModal.style.display = "none";
                        fetch_movie();
                    }else{
                        alert.style.backgroundColor = "rgb(244, 67, 54)";
                        error_message.innerText = result.messages;
                        alert.style.display = "block"; 
                    }
                }
            }

            this.footer();

        }


        delete(){

            this.header();

            http.onreadystatechange = function() {
                if (http.readyState == 4 && http.status == 200) {
                    let result = JSON.parse(http.responseText);
                    if(result.success === true){
                        alert.style.backgroundColor = "rgb(4, 170, 109)";
                        error_message.innerText = result.messages;
                        alert.style.display = "block";
                        deleteModal.style.display = "none";
                        fetch_movie();
                    }else{
                        alert.style.backgroundColor = "rgb(244, 67, 54)";
                        error_message.innerText = result.messages;
                        alert.style.display = "block"; 
                    }
                }
            }

            this.footer();

        }





    }


    function fetch_movie(){
        new HTTPRequest("includes/action.php?action=fetch", 'GET', null).fetch();
    }

    fetch_movie();


    let addModal = document.getElementById('addModal');
    let show_addModal = document.getElementById('show-addModal');
    let close_addModal = document.getElementById('close-addModal');

    show_addModal.onclick = function(){
        addModal.style.display = "block";
    }

    close_addModal.onclick = function(){
        addModal.style.display = "none";
    }

    function add_movie(e){

        let formData = 'name=' + e.name.value + '&genre=' + e.genre.value;
        new HTTPRequest("includes/action.php?action=add", e.getAttribute('method'), formData).add();

    }



    let editModal = document.getElementById('editModal');
    let close_editModal = document.getElementById('close-editModal');

    function show_editModal(e){

        editModal.style.display = "block";
        
        document.getElementById('e_id').value = e.getAttribute('id');
        document.getElementById('e_name').value = e.getAttribute('name');
        document.getElementById('e_genre').value = e.getAttribute('genre');
        

    };

    close_editModal.onclick = function(){
        editModal.style.display = "none";
    };

    function update_movie(e){

        let formData = 'id=' + e.e_id.value + '&name=' + e.e_name.value + '&genre=' + e.e_genre.value;
        new HTTPRequest("includes/action.php?action=update", e.getAttribute('method'), formData).update();

    }


    let deleteModal = document.getElementById('deleteModal');

    function show_deleteModal(e){

        deleteModal.style.display = "block";
        document.getElementById('movieNameDelete').innerText = e.getAttribute('name');

        document.getElementById('delete_movie').onclick = function(){
            let id = 'id=' + e.getAttribute('id');
            new HTTPRequest("includes/action.php?action=delete", "POST", id).delete();
        };
        
    }

    function close_deleteModal(){
        deleteModal.style.display = "none";
    };


