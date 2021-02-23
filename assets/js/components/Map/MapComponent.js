import { MapContainer, TileLayer, Marker, Popup } from 'react-leaflet';
import ReactLeafletKml from 'react-leaflet-kml';
import FlyToMyPositionButton from './FlyToMyPositionButton';

function MapComponent( {
    markerData,
    kmlContent,
    popupDescription,
    setPopupDescription
} ) {

    const handleClick = ( object ) => {
        setPopupDescription( object );
    };

     console.log( kmlContent );

    return (
        <div
            className="align-self-start col-12 min-height-330px mt-lg-0 col-lg-9 px-0 d-flex position-relative bg-lighter">
            <MapContainer
                style={{
                    width: '100%',
                    height: '700px'
                }}
                center={[ 50.22799745011792, 5.34405188915553 ]}
                zoom={13}
                scrollWheelZoom={false}
            >
                <TileLayer
                    attribution='&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
                    url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
                />

                {markerData?.map( ( object, index ) => {
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
                            <Popup className="d-block d-lg-none">
                                <h3 className="mb-3 text-center text-dark-primary">
                                    {popupDescription?.societe}
                                </h3>
                                <p className="m-0 p-0 text-center text-dark-primary">
                                    {popupDescription?.telephone}
                                </p>
                                <p className=" m-0 p-0 text-center text-dark-primary">
                                    {popupDescription?.email}
                                </p>
                                <a
                                    href={popupDescription?.website}
                                    target="_blank"
                                    className="m-0 p-0 text-center text-dark-primary d-block"
                                >
                                    {popupDescription?.website}
                                </a>
                            </Popup>
                        </Marker>
                    );
                } )}
                <FlyToMyPositionButton/>
                {kmlContent && <ReactLeafletKml kml={kmlContent}/>}
            </MapContainer>
        </div>
    );
}

export default MapComponent;
