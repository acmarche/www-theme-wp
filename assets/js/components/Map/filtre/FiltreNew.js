import FiltreLi from './FiltreLi';
import FiltreSelect from './FiltreSelect';
import { loadFiltres } from '../service/map-service';

const { useState, useEffect } = wp.element;

function FiltreNew( setMarkerData, setKmlKey ) {
    const [ filtres, setFiltres ] = useState([]);

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

    function onChange() {

    }

    return (
        <>
            {/* <!--tabs --> */}
            <div
                className="col-12 col-lg-3 px-0 lg-shadow-sm-1 position-relative z-10 overflowY-auto mh-700px">
                <FiltreLi
                    filtres={filtres}
                    setMarkerData={ setMarkerData}
                    setKmlKey={setKmlKey}
                />
                <FiltreSelect
                    filtres={filtres}
                    setMarkerData={ onChange()}
                    setKmlKey={setKmlKey}/>
            </div>
        </>
    );
}

export default FiltreNew;
