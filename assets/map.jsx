import React  from 'react';
import {MapContainer, TileLayer} from "react-leaflet";
//import { MapContainer, TileLayer, LayerGroup, Circle } from 'react-leaflet';

class Map extends React.Component {

    render() {

        return (
            <MapContainer center={[47.762727, 7.289758]} zoom={15} scrollWheelZoom={false} style={{ height: 400, width: "100%" }} >
                <TileLayer
                    attribution='&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
                    url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png" />
            </MapContainer>
        );
    }

}
export default Map;
