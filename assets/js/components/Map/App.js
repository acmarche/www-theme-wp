import MapComponent from './MapComponent';
import FiltreJf from './FiltreJf';
import { loadFiltres, loadKml } from './service/map-service';

const { useState, useEffect } = wp.element;

function App() {
    const [ markerData, setMarkerData ] = useState([]);
    const [ filtres, setFiltres ] = useState([]);
    const [ popupDescription, setPopupDescription ] = useState();
    const [ kmlKey, setKmlKey ] = useState( null );
    const [ kmlContent, setKmlContent ] = useState( null );

    async function loadingFiltres() {
        let response;
        try {
            response = await loadFiltres();
            const { data } = response;
            setFiltres( data );
        } catch ( e ) {
            console.log( e );
        }
        return null;
    }

    useEffect( () => {
        loadingFiltres();
    }, [ ]);

    async function loadingKml() {
        let response;

        //   console.log( `load kml ${kmlKey}` );
        try {
            response = await loadKml( kmlKey );
            const { data } = response;

            //     console.log( data );
            const parser = new DOMParser();
            const content = parser.parseFromString( data.kmlText, 'text/xml' );
            setKmlContent( content );
        } catch ( e ) {
            console.log( e );
        }
    }

    useEffect( () => {
        if ( null !== kmlKey ) {
            loadingKml();
        }
    }, [ kmlKey ]);

    /*   window.addEventListener( 'resize', () => {
        950 < window.innerWidth && 992 > window.innerWidth ?
            window.location.reload() :
            null;
    });*/

    return (
        <>
            <FiltreJf
                filtres={filtres}
                markerData={markerData}
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

export default App;
