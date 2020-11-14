import React, { Component } from 'react';
import { MapContainer, TileLayer, LayerGroup, Circle } from 'react-leaflet';
import LocationMarker from './LocationMarker';
//import MarketList from '../data/market.json';
import MarketLayer from './MarketLayer';


class Map extends Component {

  constructor(props) {
    super(props);
    this.state = {
      marketData: [],
      loading: true,
      coordinates: {
        lat: 48.5612853,
        lng: 7.7533103
      }
    }
  }

  componentDidMount() {

    const lat = this.state.coordinates.lat;
    const lng = this.state.coordinates.lng;

    const url = `/api/points/nearest?lat=` + lat + `&long=` + lng;

    fetch(url, { method: 'get' })
        .then(function(response) {
          return response.json();
        })
        .then(json => {
          console.log(json)
          // if (response.status === 200) {
          //   console.log(response.data); // a voir si OK
          this.setState({ marketData: json, loading: true });
          // }

        });
  }

  handleChange = (coordinates) => {
    console.log('handleChange', coordinates);
    this.setState({ coordinates: coordinates, loading: true });

    const lat = this.state.coordinates.lat;
    const lng = this.state.coordinates.lng;

    debugger;

    // URL à modifier en fonction du site
    const url = `/api/points/nearest?lat=` + lat + `&long=` + lng;

    fetch(url, { method: 'get' })
        .then(function(response) {
          return response.json();
        })
        .then(json => {

          this.setState({ marketData: json, loading: true });

        // if (response.status === 200) {
        //   console.log(response.data); // a voir si OK
        //   this.setState({ marketData: response.data, loading: true });
        // }

      });

  }



  render() {
    const fillBlueOptions = { fillColor: 'blue' };
    const center = [47.762727, 7.289758];
    if (this.state.loading) {
      return (
        <MapContainer center={center} zoom={9} scrollWheelZoom={false} style={{ height: 800, width: "100%" }} >
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
