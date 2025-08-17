//CRUD For Projects

function deleteProject(id){
    if (confirm(`Are you sure you want to delete this project[${id}]?`)){
        window.location = `/projects/delete?id=${id}`;
    }
}

function deleteExperience(id){
    if (confirm(`Are you sure you want to delete this experience[${id}]?`)){
        window.location = `/experiences/delete?id=${id}`;
    }
}