//CRUD For Projects

function deleteProject(id){
    if (confirm(`Are you sure you want to delete this project[${id}]?`)){
        window.location = `/projects/delete?id=${id}`;
    }
}