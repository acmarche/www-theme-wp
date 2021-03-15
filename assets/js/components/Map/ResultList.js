import ResultItem from './ResultItem';

function ResultList({
    markerData,
    optionSelected
}) {
    console.log( markerData );
    if ( 0 === markerData.length ) {
        return ( <>
            <div className="d-flex flex-column w-100 h-100 px-32px">
                <h3 className="pt-32px text-dark-primary">Liste vide</h3>
                <ul className="d-flex flex-wrap pt-16px mx-n11px">

                </ul>
            </div>
        </> );
    }

    const listItems = markerData.map( ( object, index ) => (
        <ResultItem
            key={index}
            item={object}
        />
    ) );

    return (
        <>
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
