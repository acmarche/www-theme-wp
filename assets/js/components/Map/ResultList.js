import ResultItem from './ResultItem';

function ResultList({
    markerData
}) {
    console.log( markerData );

    const listItems = markerData
        .map( ( object, index ) => (
            <ResultItem
                key={index}
                item={object}
            />
        ) );

    return (
        <>
            <div className="d-flex flex-column w-100 h-100 px-32px">
                <h3 className="pt-32px text-dark-primary">Maternel / Primaire</h3>
                <ul className="d-flex flex-wrap pt-16px mx-n11px">
                    {listItems}
                </ul>
            </div>
        </>
    );
}

export default ResultList;
