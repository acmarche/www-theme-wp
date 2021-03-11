import FiltreLiE from './FiltreLiE';

function FiltreLi( propos ) {
    const data = Object.keys( propos.filtres );
    const { handleClick } = propos;
    const listItems = data
        .map( ( key, values ) => (
            <FiltreLiE
                key={key}
                keyword={key}
                filtre={Object.entries( propos.filtres[key])}
                handleClick={ handleClick} />
        ) );

    return (
        <>
            <ul className="d-none d-lg-block border-bottom border-default">
                {listItems}
            </ul>
        </>
    );
}

export default FiltreLi;
