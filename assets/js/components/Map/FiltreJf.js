import CollapseCategoryJf from './CollapseCategoryJf';
import PopupDescription from './PopupDescription';

function FiltreJf({
    filtres,
    markerData,
    setMarkerData
}) {
    const listItems = Object.keys( filtres ).map( ( key ) => (
        <CollapseCategoryJf
            key={key}
            targetControlIdCollapse={`target-${key}`}
            categories={filtres[key]}
            setMarkerData={setMarkerData}/>
    ) );

    return (
        <div className="accordion" id="accordionFiltres">
            <div className="col-12 col-lg-3 px-0 lg-shadow-sm-1 position-relative z-10">
                {listItems}
            </div>
        </div>
    );
}

export default FiltreJf;
