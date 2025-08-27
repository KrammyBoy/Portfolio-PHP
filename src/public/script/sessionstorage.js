function setItemToSessionStorage(key, array){
    if(sessionStorage.getItem(key) !== null){
        sessionStorage.removeItem(key);
    }
    sessionStorage.setItem(key, JSON.stringify(array))
}

function displayAllValuesOfSession() {
    const values = [];

    for (let i = 0; i < sessionStorage.length; i++) {
        let key = sessionStorage.key(i);
        values.push(sessionStorage.getItem(key));
    }

    console.log(values); // array of values
}
