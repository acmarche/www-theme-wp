import { MapContainer, TileLayer, Marker, Popup, Tooltip  } from 'react-leaflet';
import ReactLeafletKml from 'react-leaflet-kml';
import ControlButtons from './ControlButtons';

const {
    useState
} = wp.element;

function MapComponent( {
    markerData,
    kmlContent,
    popupDescription,
    setPopupDescription
} ) {

    const [ map, setMap ] = useState( null );

    const handleClick = ( object ) => {
        setPopupDescription( object );
    };

    function handleCreated( map ) {
        setMap( map );
    }

    const handleBtn = ( object ) => {
        const containerMap = document.getElementById( 'leaflet-container' );
        if (object === 'map') {
            containerMap.classList.remove( 'd-none' );
            containerMap.classList.add( 'd-block' );
        }
        if (object === 'list') {
            containerMap.classList.add( 'd-none' );
            containerMap.classList.remove( 'd-block' );
        }
    };

    return (
        <>
            <div
                className=" d-flex w-64px h-32px position-absolute top-16px right-16px z-20 shadow-sm-1">
            </div>
            <input type="radio" id="btn_list_view" name="view"
                   onChange={() => handleBtn( 'list' )}/>
            <span
                className="d-flex align-items-center justify-content-center w-32px h-32px position-absolute top-16px right-48px z-30 icon_custom">
                            <i className="i-list w-18px h-18px bg-size-auto"></i>
                        </span>
            <input type="radio" id="btn_map_view" name="view"
                   onChange={() => handleBtn( 'map' )}/>
            <span
                className="d-flex align-items-center justify-content-center w-32px h-32px position-absolute top-16px right-16px z-30 border-left icon_custom">
                            <i className="i-map w-18px h-18px bg-size-auto"></i>
                        </span>

            <ControlButtons map={map}/>
            <div
                className="position-absolute h-100 w-lg-100 h-lg-auto z-10"
                style={{ width: 100 + '%' }}>
                <MapContainer
                    id={'leaflet-container'}
                    style={{
                        width: '100%',
                        height: '700px'
                    }}
                    whenCreated={handleCreated}
                    center={[ 50.22799745011792, 5.34405188915553 ]}
                    zoom={13}
                    zoomControl={false}
                    scrollWheelZoom={false}
                >
                    <TileLayer
                        attribution='&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
                        url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
                    />
                    {markerData?.map( ( object, index ) => {
                        if (object.latitude && object.longitude) {

                            return (
                                <Marker
                                    eventHandlers={{
                                        click: () => {
                                            handleClick( object );
                                        }
                                    }}
                                    key={index}
                                    position={[ object.latitude, object.longitude ]}
                                >
                                    <Tooltip><p>{object?.nom}</p></Tooltip>
                                    <Popup className="d-block d-lg-no2ne">
                                        <h3 className="mb-3 text-center text-dark-primary">
                                            {object?.nom}
                                        </h3>
                                        <p className="m-0 p-0 text-center text-dark-primary">
                                            {object?.telephone}
                                        </p>
                                        <p className="m-0 p-0 text-center text-dark-primary">
                                            {object?.rue}
                                            <br/>
                                            {object?.localite}
                                        </p>
                                        <p className=" m-0 p-0 text-center text-dark-primary">
                                            {object?.email}
                                        </p>
                                        <a
                                            href={object?.url}
                                            target="_blank"
                                            className="mt-2 btn btn-outline-success m-0 p-0 text-center d-block"
                                        >
                                            Consulter la fiche
                                        </a>
                                        <a
                                            className="btn btn-outline-primary mt-2 m-0 p-0 text-center d-block"
                                            target="_blank"
                                            href={`https://www.google.com/maps/search/?api=1&query=${object.latitude},${object.longitude}`}
                                        >
                                            Itineraire
                                        </a>
                                    </Popup>
                                </Marker>
                            );
                        }
                    } )}
                    {kmlContent && <ReactLeafletKml kml={kmlContent}/>}
                </MapContainer>
            </div>
        </>
    );
}

export default MapComponent;
