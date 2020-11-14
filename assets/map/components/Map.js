import React, { Component } from 'react';
import { MapContainer, TileLayer } from 'react-leaflet';
import LocationMarker from './LocationMarker';
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
           if (response.status === 200) {
          //   console.log(response.data); // a voir si OK
          this.setState({ marketData: json, loading: true });
          console.log(this.state)

           }
        });
  }

  handleChange = (coordinates) => {
    console.log('handleChange', coordinates);
    this.setState({ coordinates: coordinates, loading: true });

    const lat = this.state.coordinates.lat;
    const lng = this.state.coordinates.lng;

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
    if (this.state.loading) {
      const center = [this.state.coordinates.lat, this.state.coordinates.lng];

      return (
        <MapContainer center={center} zoom={15} scrollWheelZoom={false} style={{ height: 500, width: "100%" }} >
          <TileLayer
            attribution='&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
            url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png" />

          <LocationMarker handleChange={this.handleChange} />
          <MarketLayer marketData={this.state.marketData} />

        </MapContainer>
      );
    } else {
      return (<h5>wait... </h5>);
    }
  }
}
export default Map;
