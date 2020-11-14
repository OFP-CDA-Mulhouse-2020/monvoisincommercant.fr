import L from 'leaflet';
import imgPerson from '../images/marker-icon.png';
import imgPersonShadow from '../images/marker-shadow.png';

let IconMarket = L.Icon.extend({
    options: {
        shadowUrl: '',
        iconSize: [20, 20],
        shadowSize: [20, 20],
        iconAnchor: [10, 10],
        shadowAnchor: [0, 0],
        popupAnchor: [-3, -10]
    }
});


let iconPerson = new L.Icon({
    iconUrl: imgPerson,
    shadowUrl: imgPersonShadow,
    iconSize: [38, 75], // size of the icon
    shadowSize: [50, 64], // size of the shadow
    iconAnchor: [15, 55], // point of the icon which will correspond to marker's location
    shadowAnchor: [10, 45],  // the same for the shadow
    popupAnchor: [5, -55] // point from which the popup should open relative to the iconAnchor
});

export { iconPerson };

export { IconMarket };