import MapComponent from './MapComponent';
import FiltreNew from './filtre/FiltreNew';
import { loadKml } from './service/map-service';
import ResultList from './ResultList';

const { useState, useEffect } = wp.element;

function App() {
    const [ markerData, setMarkerData ] = useState([]);
    const [ optionSelected, setOptionSelected ] = useState([]);
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
            <FiltreNew
                setMarkerData={setMarkerData}
                setKmlKey={setKmlKey}
                setOptionSelected={setOptionSelected}
            />
            <div className="col-12 min-height-330px mt-24px mt-lg-0 col-lg-9 px-0 d-flex align-items-center justify-content-center overflow-hidden position-relative bg-lighter object-mapviews">
                <MapComponent
                    popupDescription={popupDescription}
                    setPopupDescription={setPopupDescription}
                    markerData={markerData}
                    kmlContent={kmlContent}/>
                <ResultList
                    optionSelected={optionSelected}
                    markerData={markerData}/>
            </div>
        </>
    );
}

export default App;
