function FiltreLiE( propos ) {
    const { filtre, keyword, handleClick } = propos;

    if ( ! filtre ) {
        return (
            <></>
        );
    }

    const name = filtre[0][1];
    const icone = filtre[1][1];
    const elements = filtre[2][1];
    const entries = Object.entries( elements );

    const listItems = entries
        .map( ( values, key ) => (
            <li
                key={values[0]}
                onClick={() => handleClick( values[0], values[1].name )}>
                <input
                    type="radio"
                    id={ `sublist_element-${keyword}-${values[0]}` }
                    name="sublist_element"
                    onChange={() => {}}/>
                <span>{values[1].name}</span>
            </li>
        ) );

    return (
        <>
            <li className="border-top border-default object-sublist" id={ `list_element-${keyword}` }>
                <input type="radio" id={ `list_element-${keyword}` } name="list_element" onChange={() => {}}/>
                <span className="icon_custom"><i className={`${icone} w-22px h-22px mr-16px bg-size-auto`}></i>{name}</span>
                <ul>
                    {listItems}
                </ul>
            </li>
        </>
    );
}

export default FiltreLiE;
