import { MapContainer, TileLayer, Marker, Popup, Tooltip } from 'react-leaflet';
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

    return (
        <div
            className="col-12 min-height-330px mt-24px mt-lg-0 col-lg-9 px-0 d-flex align-items-center justify-content-center overflow-hidden position-relative bg-lighter">
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

                   if(object.latitude&&object.longitude) {

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
                    );}
                } )}
                <FlyToMyPositionButton/>
                {kmlContent && <ReactLeafletKml kml={kmlContent}/>}
            </MapContainer>
        </div>
    );
}

export default MapComponent;
