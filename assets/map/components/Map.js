import React, {Component} from 'react';
import {MapContainer, TileLayer} from 'react-leaflet';
import LocationMarker from './LocationMarker';
import MarketLayer from './MarketLayer';


class Map extends Component {

    constructor(props) {
        super(props);

        this.state = {
            marketData: [],
            loading: false,
            coords: {
                lat: null,
                lng: null,
            } 
        }
      this.fetchMerchants = this.fetchMerchants.bind(this)
    }

    componentDidMount() {

        // pour pouvoir utiliser le state dans le callback
        let $this = this
      
        navigator.geolocation.getCurrentPosition(function (position) {
            $this.setState({
                loading: true,
                coords: {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude,
                }
            })
            $this.fetchMerchants($this.state.coords)
        });
    }

    fetchMerchants = (coordinates) => {

        this.setState({coords: coordinates, loading: true});

        const url = `/api/points/nearest?lat=` + this.state.coords.lat + `&long=` + this.state.coords.lng;

        fetch(url, {method: 'get'})
            .then(function (response) {
                return response.json();
            })
            .then(json => {
                this.setState({marketData: json, loading: true});
            });
    }

    //handle change est obligatoire pour le marker
    handleChange = (coordinates) => {
      this.fetchMerchants(coordinates);
    }

    render() {
        if (this.state.loading) {
            const center = [this.state.coords.lat, this.state.coords.lng];

            return (
                <MapContainer center={center} zoom={15} scrollWheelZoom={false} style={{height: 500, width: "100%"}}>
                    <TileLayer
                        attribution='&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
                        url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"/>

                    <LocationMarker handleChange={this.handleChange}  coords={this.state.coords}/>
                    <MarketLayer marketData={this.state.marketData}/>

                </MapContainer>
            );
        } else {
            return (<h5>Chargement... </h5>);
        }
    }
}

export default Map;
