import Axios from '../Axios';
import MapComponent from './MapComponent';
import FiltreJf from './FiltreJf';
import Top from './Top';
import { filtres } from './service/map-service';

const { useState, useEffect } = wp.element;

function App() {
    const [ markerData, setMarkerData ] = useState([]);
    const [ categories, setCategories ] = useState([]);
    const [ popupDescription, setPopupDescription ] = useState();

    async function loadFiltres() {
        let response;
        try {
            response = await filtres();
            const { data } = response;
            setCategories( data );
        } catch ( e ) {
            console.log( e );
        }
        return null;
    }

    useEffect( () => {
        loadFiltres();
    }, [ ]);

    window.addEventListener( 'resize', () => {
        950 < window.innerWidth && 992 > window.innerWidth ?
            window.location.reload() :
            null;
    });

    return (
        <>
            <div className="bg-white pt-24px px-24px position-relative d-md-flex px-xl-48px mx-xl-n30px justify-content-md-center flex-column">
                <Top />
                <div className="mt-48px d-flex flex-column flex-lg-row mx-0 mx-lg-n48px overflow-hidden align-items-lg-stretch mx-xxl-0 xxl-shadow-sm-1">
                    <FiltreJf
                        categories={categories}
                        markerData={markerData}
                        setMarkerData={setMarkerData}
                    />

                    <MapComponent
                        popupDescription={popupDescription}
                        setPopupDescription={setPopupDescription}
                        markerData={markerData}
                    />
                </div>
            </div>
        </>
    );
}

export default App;
