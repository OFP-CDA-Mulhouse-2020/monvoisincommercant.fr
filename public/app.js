let adress = document.querySelector("#merchantform_adress");
let street = document.querySelector("#merchantform_street");
let streetnumber = document.querySelector("#merchantform_streetnumber");
let codepostal = document.querySelector("#merchantform_codepostal");
let city = document.querySelector("#merchantform_city");
let cordonneesX = document.querySelector("#merchantform_cordonneX");
let cordonneesY = document.querySelector("#merchantform_cordonneY");

function play(){
    const apiUrl = 'https://api-adresse.data.gouv.fr/search/?q=';
    const type = '&type=housenumber';
    const format = '&format=json';

    let code = adress.value;

    code = code.replace(/\s+/g, '+');

    //console.log(code);
    let url = apiUrl + code + type + format;
    console.log(url);
    return url
}
function listeadress(){

    let data = play();
    fetch(data, {methode: 'get'}).then(response => response.json().then(results => {
        const select = document.cereateElement()
    }))

}
function dataadress(){
    let data = play();
    fetch(data, {method: 'get'}).then(response => response.json()).then(results => {

        //console.log(results.features[0].geometry.coordinates[1]);

        streetnumber.value = results.features[0].properties.housenumber;
        street.value = results.features[0].properties.street;
        codepostal.value = results.features[0].properties.postcode;
        city.value = results.features[0].properties.city
        cordonneesX.value = results.features[0].geometry.coordinates[1];
        cordonneesY.value = results.features[0].geometry.coordinates[0];
    })}
adress.addEventListener("change",dataadress);
adress.addEventListener("keyup",dataadress);