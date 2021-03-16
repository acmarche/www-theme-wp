import MapComponent from './MapComponent';
import FiltreJf from './FiltreJf';
import { loadKml } from './service/map-service';

const { useState, useEffect } = wp.element;

function AppSave() {
    const [ markerData, setMarkerData ] = useState([]);
    const [ popupDescription, setPopupDescription ] = useState();
    const [ kmlKey, setKmlKey ] = useState( null );
    const [ kmlContent, setKmlContent ] = useState( null );

    async function loadingKml() {
        let response;
        try {
            response = await loadKml( kmlKey );
            const { data } = response;
            const parser = new DOMParser();
            const content = parser.parseFromString( data.kmlText, 'text/xml' );
            setKmlContent( content );
        } catch ( e ) {
            console.log( e );
        }
    }

    useEffect( () => {
        if ( null !== kmlKey ) {
            setKmlContent( null );//reset
            loadingKml();
        } else {
            setKmlContent( null );
        }
    }, [ kmlKey ]);

    window.addEventListener( 'resize', () => {
        950 < window.innerWidth && 992 > window.innerWidth ?
            window.location.reload() :
            null;
    });

    return (
        <>
            <FiltreJf
                setMarkerData={setMarkerData}
                setKmlKey={setKmlKey}
            />
            <MapComponent
                popupDescription={popupDescription}
                setPopupDescription={setPopupDescription}
                markerData={markerData}
                kmlContent={kmlContent}
            />
        </>
    );
}

export default AppSave;