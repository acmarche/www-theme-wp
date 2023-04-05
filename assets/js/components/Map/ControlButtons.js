import L from 'leaflet';
import useGeolocation from './hooks/useGeolocation';

function ControlButtons( propos ) {
    const { map } = propos;
    const location = useGeolocation();

    const zoomIn = ( e ) => {
        e.preventDefault();
        map.setZoom( map.zoom + 1 );
    };
    const zoomOut = ( e ) => {
        e.preventDefault();
        console.log(map);
        map.setZoom( map.zoom - 1 );
    };
    const showMyLocation = () => {
        if ( location.loaded && ! location.error ) {
            L.marker([ location.coordinates.lat, location.coordinates.lng ]).addTo( map );
            map.flyTo(
                [ location.coordinates.lat, location.coordinates.lng ],
                map.zoom
            );
        } else {
            alert( location.error.message );
        }
    };

    return (
        <>
            <div
                className="d-flex flex-column w-32px position-absolute top-16px left-16px z-20 shadow-sm-1">
                <span onClick={ zoomIn} title={'Zoom'} style={{ cursor: 'pointer' }}
                    className="d-flex align-items-center justify-content-center w-32px h-32px bg-white icon_custom">
                    <i className="i-search-plus w-18px h-18px bg-size-auto"></i>
                </span>
                <span onClick={ zoomOut} title={'Zoom'} style={{ cursor: 'pointer' }}
                    className="d-flex align-items-center justify-content-center w-32px h-32px bg-white icon_custom border-top">
                    <i className="i-search-less w-18px h-18px bg-size-auto"></i>
                </span>
                <span onClick={ showMyLocation} title={'Où suis-je'} style={{ cursor: 'pointer' }}
                    className="d-flex align-items-center justify-content-center w-32px h-32px bg-white icon_custom border-top">
                    <i className="i-chrono w-18px h-18px bg-size-auto"></i>
                </span>
            </div>
        </>
    );
}

export default ControlButtons;
