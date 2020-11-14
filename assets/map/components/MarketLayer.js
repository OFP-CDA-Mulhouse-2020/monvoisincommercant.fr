import React from 'react';
import {LayerGroup, Marker, Popup} from 'react-leaflet';
import 'leaflet/dist/leaflet.css';
import {IconMarket} from './Icon';

const MarketLayer = (props) => {

    const rows = props.marketData.map((row, index) => {

        let svg = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50" width="50" height="50">' +
            '<circle cx="20" cy="20" r="20" fill="' + row.category.color + '" />' +
            '</svg>';
        let iconMarket = new IconMarket({iconUrl: 'data:image/svg+xml;base64,' + btoa(svg)});

         return (
            <Marker position={row.position} icon={iconMarket} key={index}>
                <Popup>
                    <div style={{
                        backgroundColor: row.category.color,
                        height: "10px",
                        width: "10px",
                        display: "inline-block",
                        marginRight: "5px"
                    }}></div>
                    Magasin : {row.name}<br/>
                    Description : {row.description}<br/>
                    <a href={row.website}>{row.website}</a><br/>
                </Popup>
            </Marker>
        )
    })

    return <LayerGroup>
        {rows}
    </LayerGroup>

}


export default MarketLayer;
