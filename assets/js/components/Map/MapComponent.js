import { MapContainer, TileLayer, Marker, Popup, Tooltip } from 'react-leaflet';
import ReactLeafletKml from 'react-leaflet-kml';
import ControlButtons from './ControlButtons';
import PopupBottin from './Popup/PopupBottin';
import PopupKml from './Popup/PopupKml';

const {
    useState
} = wp.element;

function MapComponent( {
    markerData,
    kmlContent
} ) {

    const [ map, setMap ] = useState( null );

    const handleClick = ( object ) => {
        //do nothing
    };

    function handleCreated( map ) {
        setMap( map );
    }

    return (
        <>
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
                        console.log(object);
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
                                    {object.kml && <PopupKml object={object}/>}
                                    {object.kml===false && <PopupBottin object={object}/>}
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
