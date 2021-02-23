import CollapseCategoryJf from './CollapseCategoryJf';
import PopupDescription from './PopupDescription';

function FiltreJf({
    categoriesToDisplay,
    markerData,
    setMarkerData
}) {
    const listItems = Object.keys( categoriesToDisplay ).map( ( key, index ) => (
        <CollapseCategoryJf
            key={key}
            name={key}
            targetControlIdCollapse={index}
            categories={categoriesToDisplay[key]}
            setMarkerData={setMarkerData}/>
    ) );

    return (
        <div className="col-12 col-lg-3 px-0 lg-shadow-sm-1 position-relative z-10">
            <div>
                {listItems}
            </div>
        </div>
    );
}

export default FiltreJf;
