import React, { Component } from 'react';
import { MapContainer, TileLayer, LayerGroup, Circle } from 'react-leaflet';
import LocationMarker from './LocationMarker';
import MarketList from '../data/market.json';
import MarketLayer from './MarketLayer';


class Map extends Component {
  constructor(props) {
    super(props);
    this.state = {
      marketData: MarketList,
      loading: true,
      coordinates: []
    }
  }

  handleChange = (coordinates) => {
    console.log('handleChange', coordinates);
    this.setState({ coordinates: coordinates, loading: true });

    const x = this.state.coordinates.lat;
    const y = this.state.coordinates.lng;

    // URL à modifier en fonction du site
    const url = `https://127.0.0.1:8000/` + x + `/` + y;

    fetch(url, { method: 'get' }).then(response => {

      if (response.status === 200) {
        console.log(response); // a voir si OK
        this.setState({ marketData: response.data, loading: true });
      }

    });

  }



  render() {
    const fillBlueOptions = { fillColor: 'blue' };
    const center = [47.762727, 7.289758];
    if (this.state.loading) {
      return (
        <MapContainer center={[47.762727, 7.289758]} zoom={15} scrollWheelZoom={false} style={{ height: 500, width: "100%" }} >
          <TileLayer
            attribution='&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
            url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png" />
          <LayerGroup>
            <Circle center={center} pathOptions={fillBlueOptions} radius={1000} />
          </LayerGroup>

          <LocationMarker handleChange={this.handleChange} />
          <MarketLayer marketData={this.state.marketData} />

        </MapContainer>
      );
    } else {
      return (<h5 className="card-title">wait... </h5>);
    }
  }
}
export default Map;
