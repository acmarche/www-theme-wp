import { Marker, useMap } from 'react-leaflet';
import useGeolocation from './hooks/useGeolocation';

function FlyToMyPositionButton() {
    const location = useGeolocation();

    const map = useMap();
    const showMyLocation = () => {
        if ( location.loaded && ! location.error ) {
            map.flyTo(
                [ location.coordinates.lat, location.coordinates.lng ],
                map.getZoom()
            );
        } else {
            alert( location.error.message );
        }
    };

    if ( location.loaded && ! location.error ) {
        return (
            <>
                <div
                    onClick={() => showMyLocation()}
                    style={{
                        backgroundColor: '#fff',
                        position: 'absolute',
                        border: 'solid 2px rgba(0,0,0,0.4)',
                        cursor: 'pointer',
                        borderRadius: 3,
                        display: 'flex',
                        justifyContent: 'center',
                        width: 30,
                        top: 80,
                        left: 12,
                        zIndex: 500
                    }}
                >
                    <img
                        style={{ width: 25 }}
                        src="https://cdn3.iconfinder.com/data/icons/mix-stroke-5/100/mix_stroke_5_area-512.png"
                        alt={'logo'}/>
                </div>
                <button
                    style={{
                        backgroundColor: 'black',
                        outline: 'none',
                        border: 'none',
                        width: 'fit-content',
                        height: 25
                    }}
                >
          Ma position
                </button>
                <Marker
                    icon={L.icon({
                        iconUrl: 'https://www.ramani.fr/images/location_icon.png',
                        iconSize: [ 30, 30 ]
                    })}
                    position={[ location.coordinates.lat, location.coordinates.lng ]}
                ></Marker>
            </>
        );
    }
    return null;
}

export default FlyToMyPositionButton;
