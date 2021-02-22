import { MapContainer, TileLayer } from 'react-leaflet';
import ReactLeafletKml from 'react-leaflet-kml';
import { loadKml } from './service/map-service';

const {
    useState,
    useEffect
} = wp.element;

function MapJf() {
    const [ kml, setKml ] = useState( null );
    const keyword = 'seniors';

    async function loading() {
        let response;
        try {
            response = await loadKml( keyword );
            const { data } = response;
            const parser = new DOMParser();
            const content = parser.parseFromString( data.kmlText, 'text/xml' );
            setKml( content );
        } catch ( e ) {
            console.log( e );
        }
        return null;
    }

    useEffect( () => {
        loading();
    }, [ keyword ]);

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

                {kml && <ReactLeafletKml kml={kml}/>}

            </MapContainer>
        </div>
    );
}

export default MapJf;
