function FiltreItemOption( filtre ) {
    const name = filtre.filtres[0][1];
    const icone = filtre.filtres[1][1];
    const elements = filtre.filtres[2][1];

    const entries = Object.entries( elements );

    const listItems = entries
        .map( ( values, key ) => (
            <option
                key={values[0]}
                value={values[0]}
            >
                {values[1].name}
            </option>
        ) );

    return ( <>
        <optgroup label={name}>
            {listItems}
        </optgroup>
    </> );
}

export default FiltreItemOption;
