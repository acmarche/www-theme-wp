import FiltreItemOption from './FiltreItemOption';

function FiltreSelect( propos ) {
    const data = Object.keys( propos.filtres );
    const { handleClick } = propos;
    const listItems = data
        .map( ( key, values ) => (
            <FiltreItemOption
                key={key}
                filtres={Object.entries( propos.filtres[key])}
            />
        ) );

    function handleChange( event ) {
        const index = event.nativeEvent.target.selectedIndex;
        const label = event.nativeEvent.target[index].text;
        const categorySelectedId = event.target.value;
        handleClick( categorySelectedId, label );
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
