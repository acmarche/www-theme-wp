function FiltreLi( propos ) {
    const data = Object.keys( propos.filtres );

    console.log( propos.filtres );

    const listItems = data
        .forEach( ( key, values ) => {
            console.log( propos.filtres[key]);
            const t = Object.entries( propos.filtres[key]);
            console.log( t );

            const name = t[0][1];
            const icone = t[1][1];
            const elements = t[2][1];
        });

    return (
        <>
            <ul className="d-none d-lg-block border-bottom border-default">
                {listItems}
            </ul>
        </>
    );
}

export default FiltreLi;
