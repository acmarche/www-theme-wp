import MapComponent from './MapComponent';
import Filtres from './filtre/Filtres';
import { loadKml } from './service/map-service';
import ResultList from './result/ResultList';
import SwitchView from './SwitchView';

const { useState, useEffect } = wp.element;

function App() {
    const [ markerData, setMarkerData ] = useState([]);
    const [ optionSelected, setOptionSelected ] = useState([]);
    const [ view, setView ] = useState( 'map' );
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

    return (
        <>
            <Filtres
                setMarkerData={setMarkerData}
                setKmlKey={setKmlKey}
                setOptionSelected={setOptionSelected}
            />
            <div
                className="col-12 min-height-330px mt-24px mt-lg-0 col-lg-9 px-0 d-flex align-items-center justify-content-center overflow-hidden position-relative bg-lighter object-mapviews">
                <div
                    className="d-flex w-64px h-32px position-absolute top-16px right-16px z-20 shadow-sm-1">
                    {/* <!--design_element--> */}
                </div>
                <SwitchView setView={setView}/>
                {
                    'map' === view &&
                <MapComponent
                    markerData={markerData}
                    kmlContent={kmlContent}/>
                }
                {
                    'list' === view &&
                <ResultList
                    optionSelected={optionSelected}
                    markerData={markerData}/>
                }
            </div>
        </>
    );
}

export default App;
