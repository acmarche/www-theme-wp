import CollapseCategoryJf from './CollapseCategoryJf';
import PopupDescription from './PopupDescription';
import { loadFiltres } from './service/map-service';

const { useState, useEffect } = wp.element;

function FiltreJf({
    markerData,
    setMarkerData,
    setKmlKey
}) {
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

    const listItems = Object.keys( filtres )
        .map( ( key ) => (
            <CollapseCategoryJf
                key={key}
                targetControlIdCollapse={`target-${key}`}
                categories={filtres[key]}
                setMarkerData={setMarkerData}
                setKmlKey={setKmlKey}/>
        ) );

    return (
        <div className="col-12 col-lg-3 px-0 lg-shadow-sm-1 position-relative z-10">
            <div className="accordion" id="accordionFiltres">
                {listItems}
            </div>
        </div>
    );
}

export default FiltreJf;
