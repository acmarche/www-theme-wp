import L from 'leaflet';
import {useMapEvents} from 'react-leaflet';
import useGeolocation from './hooks/useGeolocation';

function ControlButtons() {
    const location = useGeolocation();
    const map = useMapEvents({
        click() {
        },
    })
    const zoomIn = (e) => {
        e.preventDefault();
        if (map) {
            map.setZoom(map.getZoom() + 1);
        }
    };
    const zoomOut = (e) => {
        e.preventDefault();
        if (map) {
            map.setZoom(map.getZoom() - 1);
        }
    };
    const showMyLocation = () => {
        if (location.loaded && !location.error) {
            L.marker([location.coordinates.lat, location.coordinates.lng]).addTo(map);
            map.flyTo(
                [location.coordinates.lat, location.coordinates.lng],
                map.zoom
            );
        } else {
            alert(location.error.message);
        }
    };

    return (
        <>
            <div
                id="control-map"
                className="d-flex flex-column w-32px position-absolute top-100px left-16px shadow-sm-1" style={{zIndex:1000}}>
                <span onClick={zoomIn} title={'Zoom'} style={{cursor: 'pointer'}}
                      className="d-flex align-items-center justify-content-center w-32px h-32px bg-white icon_custom">
                    <i className="i-search-plus w-18px h-18px bg-size-auto"></i>
                </span>
                <span onClick={zoomOut} title={'Zoom'} style={{cursor: 'pointer'}}
                      className="d-flex align-items-center justify-content-center w-32px h-32px bg-white icon_custom border-top">
                    <i className="i-search-less w-18px h-18px bg-size-auto"></i>
                </span>
                <span onClick={showMyLocation} title={'Où suis-je'} style={{cursor: 'pointer'}}
                      className="d-flex align-items-center justify-content-center w-32px h-32px bg-white icon_custom border-top">
                    <i className="i-chrono w-18px h-18px bg-size-auto"></i>
                </span>
            </div>
        </>
    );
}

export default ControlButtons;
