import ResultItemBottin from './ResultItemBottin';
import ResultItemKml from './ResultItemKml';

function ResultList({
    markerData,
    optionSelected
}) {
    if ( 0 === markerData.length ) {
        return ( <>
            <div className="d-flex flex-column w-100 h-100 px-32px">
                <h3 className="pt-32px text-dark-primary">Liste vide</h3>
                <ul className="d-flex flex-wrap pt-16px mx-n11px">

                </ul>
            </div>
        </> );
    }

    const listItems = markerData.map( ( object, index ) => {
        if ( object.kml ) {
            return <ResultItemKml
                key={index}
                item={object}
            />;
        }
        return <ResultItemBottin
            key={index}
            item={object}
        />;
    });

    return (
        <>
            <div className="position-absolute h-100 w-lg-100 h-lg-auto z-10"/>
            <div className="d-flex flex-column w-100 h-100 px-32px">
                <h3 className="pt-32px text-dark-primary">{optionSelected}</h3>
                <ul className="d-flex flex-wrap pt-16px mx-n11px">
                    {listItems}
                </ul>
            </div>
        </>
    );
}

export default ResultList;
