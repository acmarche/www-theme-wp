function FiltreLiE( filtre ) {
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

    return (
        <>
            <li className="border-top border-default object-sublist">
                <input type="radio" id="list_element01" name="list_element"/>
                <span className="icon_custom"><i className="i-book w-22px h-22px mr-16px bg-size-auto"></i>{name}</span>
            </li>
        </>
    );
}

export default FiltreLiE;
