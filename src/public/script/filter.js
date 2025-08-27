function projectTechnologyFilter() {
    //Expecting an json in this to this. 
    let projects = JSON.parse(sessionStorage.getItem('projects'));
    let technologies = JSON.parse(sessionStorage.getItem('technologies'));
    let projectTechnology = JSON.parse(sessionStorage.getItem('projectTechnology'));


    //Getting the current selected value of projects
    let selectedValue = parseInt(document.getElementById('projects').value);

    //Check if the three are not null undefined and empty
    if (projects === null || technologies === null || projectTechnology === null){
        console.log('Error no values found in the projectTechnologyFilter()');
    } else if (selectedValue === null){
        console.log('projectTechnologyFilter() null value');
    }    

    console.log(technologies);
    //We only need to populate the technologies options so we get the technologies based on the relationship
    let options = [];
    let alreadyValues = [];

    projectTechnology.forEach(item => {
        if(item['id'] === selectedValue){
            alreadyValues.push(item['technology_id']);
        }
    });

    // We use the technologies to get the values needed
    technologies.forEach(item => {
        //Check if the item is not in the table
        if(!alreadyValues.includes(item['id'])){
            let opt = {
                'technology_id': item['id'],
                'technology_name': item['technology_name']
            };

            options.push(opt);
        }
    });

    
    const technoID = document.getElementById('technologies');
    
    technoID.innerHTML = '<option value="">-- Select a project --</option>';

    // Populate new options

    options.forEach(item => {
        let opt = document.createElement('option');
        opt.value = item.technology_id;
        opt.textContent = item.technology_name;
        technoID.appendChild(opt);
    })


}