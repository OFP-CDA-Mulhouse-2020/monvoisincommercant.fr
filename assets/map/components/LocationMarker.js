import React, { useCallback, useMemo, useRef, useState } from 'react';
import { useMapEvents, LayerGroup, Circle, Popup, Marker } from 'react-leaflet';
import { iconPerson } from './Icon';

function LocationMarker(props) {

  const [draggable, setDraggable] = useState(false);
  const [position, setPosition] = useState(null);
  const markerRef = useRef(null);
  let firstClick = useRef(null);

  const eventHandlers = useMemo(
    () => ({
      dragend() {
        const marker = markerRef.current
        if (marker != null) {
          setPosition(marker.getLatLng());
          console.log(marker.getLatLng());
          props.handleChange(marker.getLatLng());
        }
      },
    }),
    [],
  );

  const toggleDraggable = useCallback(() => {
    setDraggable((d) => !d)
  }, []);

  const map = useMapEvents({
    click() {
      map.locate();

    },
    locationfound(e) {

      if (firstClick.current !== 1) {
        setPosition(e.latlng);
        map.flyTo(e.latlng, map.getZoom());
        firstClick.current = 1;
        console.log(e.latlng);
        props.handleChange(e.latlng);
      }

    },

  });

  const fillBlueOptions = { fillColor: 'blue' };
  const center = position === null ? null : Object.values(position);

  return position === null ? null : (
    <LayerGroup>
      <Circle center={center} pathOptions={fillBlueOptions} radius={1000} stroke={false} />
      <Marker
        draggable={draggable}
        eventHandlers={eventHandlers}
        position={position}
        ref={markerRef}
        icon={iconPerson} >
        <Popup minWidth={90}>
          <div onClick={toggleDraggable}>
            {draggable
              ? 'Déplacez le marqueur'
              : 'Vous êtes ici (cliquez pour déplacer le marqueur)'}
          </div>
        </Popup>
      </Marker>
    </LayerGroup>
  )
}

export default LocationMarker;

