function FiltreLi( propos ) {
    const data = Object.keys( propos.filtres );

    // console.log( data );

    const listItems = data
        .forEach( ( key, values ) => {
            console.log( propos.filtres[key]);
            const t = Object.entries( propos.filtres[key]);
            console.log( t );

            const name = t[0][1];
            const icone = t[1][1];
            const elements = t[2][1];

            const entries = Object.entries( elements );
        });

    return (
        <>
            <ul className="d-none d-lg-block border-bottom border-default">
                <li className="border-top border-default object-sublist">
                    <input type="radio" id="list_element01" name="list_element"/>
                    <span className="icon_custom"><i
                        className="i-book w-22px h-22px mr-16px bg-size-auto"></i>Culture</span>
                    <ul>
                        <li>
                            <input type="radio" id="sublist_element1-1" name="sublist_element"/>
                            <span>Bibliothèque</span>
                        </li>
                        <li>
                            <input type="radio" id="sublist_element1-2" name="sublist_element"/>
                            <span>Cinéma</span>
                        </li>
                        <li>
                            <input type="radio" id="sublist_element1-3" name="sublist_element"/>
                            <span>Musées</span>
                        </li>
                        <li>
                            <input type="radio" id="sublist_element1-4" name="sublist_element"/>
                            <span>Statues / Sculptures</span>
                        </li>
                    </ul>
                </li>
            </ul>
        </>
    );
}

export default FiltreLi;
