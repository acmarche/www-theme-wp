function FiltreItemOption( filtre ) {
    console.log( filtre );
    const name = filtre.filtres[0][1];
    const icone = filtre.filtres[1][1];
    const elements = filtre.filtres[2][1];

    console.log( name );
    console.log( icone );
    console.log( elements );

    const entries = Object.entries( elements );

    const listItems = entries
        .forEach( ( key, values ) => {
            console.log( key );
        });

    return ( <>

    </> );
}

export default FiltreItemOption;
