import React from 'react';
import { LayerGroup, Marker, Popup } from 'react-leaflet';
import 'leaflet/dist/leaflet.css';
import { IconMarket } from './Icon';

const MarketLayer = (props) => {
  const marketColor = ['#462410', "#ae3d8f", "#d60000", "#ccb217", "#149e00", "#0241cc", "#4c4c4c", "#19bab6"];
  const rows = props.marketData.map((row, index) => {
    let svg = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50" width="50" height="50">' +
      '<circle cx="20" cy="20" r="20" fill="' + marketColor[row.categoryId] + '" />' +
      '</svg>';
    let iconMarket = new IconMarket({ iconUrl: 'data:image/svg+xml;base64,' + btoa(svg) });

    return (
      <Marker position={row.position} icon={iconMarket} key={index}>
        <Popup> <div style={{ backgroundColor: marketColor[row.categoryId], height: "10px", width: "10px", display: "inline-block", marginRight: "5px" }}></div>
        Magasin : {row.name}<br />
        Catégorie : {row.category}<br />
        Adresse : {row.address}<br />
        Description : {row.description}<br />
          <a href={row.website} >{row.website}</a><br />
        </Popup>
      </Marker>
    )
  })

  return <LayerGroup>
    {rows}
  </LayerGroup>

}


export default MarketLayer;