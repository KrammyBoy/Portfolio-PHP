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

function deleteExperience(id){
    if (confirm(`Are you sure you want to delete this certificate[${id}]?`)){
        window.location = `/certificates/delete?id=${id}`;
    }
}

function deleteTechnology(id){
    if (confirm(`Are you sure you want to delete this technology[${id}]`)){
        window.location = `/technologies/delete?id=${id}`;
    }
}


function deleteProjectTechnology(id, technology_id){
    if (confirm(`Are you sure you want to delete this technology[${id}]`)){
        window.location = `/project-technologies/delete?id=${id}&technology_id=${technology_id}`;
    }
}