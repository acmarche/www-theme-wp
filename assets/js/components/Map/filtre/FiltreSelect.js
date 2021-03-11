import FiltreItemOption from './FiltreItemOption';

function FiltreSelect( propos ) {
    const data = Object.keys( propos.filtres );

    const { handleClick } = propos;

    // console.log( data );

    const listItems = data
        .map( ( key, values ) => (
            <FiltreItemOption
                key={key}
                filtres={Object.entries( propos.filtres[key])}
            />
        ) );

    function handleChange( e ) {
        console.log( e );
    }

    return (
        <>
            <div className="d-block d-lg-none pr-12px border border-dark-primary">
                <select onChange={handleChange} name="tabs" id="tab-select" className="fs-short-3 ff-semibold">
                    {listItems}
                </select>
            </div>
        </>
    );
}

export default FiltreSelect;
