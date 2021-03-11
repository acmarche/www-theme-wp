function FiltreLiE( filtre ) {
    const name = filtre.filtres[0][1];
    const icone = filtre.filtres[1][1];
    const elements = filtre.filtres[2][1];

    const entries = Object.entries( elements );

    const listItems = entries
        .map( ( values, key ) => (
            <li key={values[0]}>
                <input type="radio" id="sublist_element1-1" name="sublist_element"/>
                <span>{values[1].name}</span>
            </li>
        ) );

    return (
        <>
            <li className="border-top border-default object-sublist">
                <input type="radio" id="list_element01" name="list_element"/>
                <span className="icon_custom"><i className="i-book w-22px h-22px mr-16px bg-size-auto"></i>{name}</span>
                <ul>
                    {listItems}
                </ul>
            </li>
        </>
    );
}

export default FiltreLiE;
